import axios from "axios";

const SINGLE_CATEGORY_ARRAY = document.querySelectorAll(".produkty__category");
const SINGLE_TAG_ARRAY = document.querySelectorAll(".produkty__tag");
const PRODUCTS_DIV = document.querySelector(".produkty__list");
let currentCategory = "";
let currentTag = "";

const makeActive = element => {
  element.classList.add("active");
};

const clearActiveAll = containingArray => {
  for (const element of containingArray) {
    element.classList.remove("active");
  }
};

const clearProducts = () => {
  while (PRODUCTS_DIV.firstChild) {
    PRODUCTS_DIV.removeChild(PRODUCTS_DIV.firstChild);
  }
};

const createProduct = product => {
  //get data from REST API response
  const productImage = product.cmb2.product.image;
  const productId = "Nr " + product.id;
  const productPrice = product.cmb2.product.price + " zł";
  //prepare product container
  const productDiv = document.createElement("div");
  productDiv.setAttribute("class", "produkty__item");
  //prepare and append product image
  const image = document.createElement("img");
  image.setAttribute("src", productImage);
  image.setAttribute("alt", "zdjęcie kartki");
  productDiv.appendChild(image);
  //prepare and append product id
  const idElement = document.createElement("p");
  idElement.setAttribute("class", "produkty__nr");
  const idText = document.createTextNode(productId);
  idElement.appendChild(idText);
  productDiv.appendChild(idElement);
  //prepare and append product price
  const priceElement = document.createElement("p");
  priceElement.setAttribute("class", "produkty__price");
  const priceText = document.createTextNode(productPrice);
  priceElement.appendChild(priceText);
  productDiv.appendChild(priceElement);
  //append product to DOM, to nie jest 'pure function' bo korzysta z wartości znajdującej się poza funkcją (PRODUCTS_DIV)
  PRODUCTS_DIV.appendChild(productDiv);
};

//give event listener to all tags
for (const singleTag of SINGLE_TAG_ARRAY) {
  singleTag.addEventListener("click", () => {
    clearActiveAll(SINGLE_TAG_ARRAY);
    makeActive(singleTag);

    const requestedCategory = singleTag.dataset.category;
    const requestedTag = singleTag.dataset.tag;

  const url = `/wp-json/wp/v2/product/?per_page=9&page=1${requestedCategory != "" ? `&categories=${requestedCategory}` : ""}${requestedTag != "" ? `&tags=${requestedTag}` : ""}`;
    axios.get(url).then(response => {
      if(response.data.length<9){
        arrowForward.style.display='none';
      }else{
        arrowForward.style.display='block';
      }
      clearProducts();
      currentCategory = requestedCategory;
      currentTag = requestedTag;
      currentPage = 1;
      arrowBack.style.display = "none";
      for (const product of response.data) {
        createProduct(product);
      }
    });
  });
}

const TAGS_CONTAINER_ARRAY = document.querySelectorAll(".produkty__tags");

for (const singleCategory of SINGLE_CATEGORY_ARRAY) {
  singleCategory.addEventListener("click", () => {
    clearActiveAll(SINGLE_CATEGORY_ARRAY);
    clearActiveAll(SINGLE_TAG_ARRAY);
    makeActive(singleCategory);
    //hide all previously shown tags

    for (const tagsContainer of TAGS_CONTAINER_ARRAY) {
      tagsContainer.classList.remove("active");
    }
    //show all tags of currently selected category
    for (const tagsContainer of TAGS_CONTAINER_ARRAY) {
      if (tagsContainer.dataset.category == singleCategory.dataset.category) {
        makeActive(tagsContainer);
        break;
      }
    }
  });

  //event listener to get API data
  singleCategory.addEventListener("click", () => {
    const requestedCategory = singleCategory.dataset.category;
    const url = `/wp-json/wp/v2/product/?per_page=9&page=1${requestedCategory != "" ? `&categories=${requestedCategory}` : ""}`;
    //make API request
    axios.get(url).then(response => {
      if(response.data.length<9){
        arrowForward.style.display='none';
      }else{
        arrowForward.style.display='block';
      }
      clearProducts();
      currentCategory = requestedCategory;
      currentTag = "";
      currentPage = 1;
      arrowBack.style.display = "none";
      for (const product of response.data) {
        createProduct(product);
      }
    });
  });
}

let currentPage = 1;
let pageNumber = document.querySelector(".num");
pageNumber.innerHTML = currentPage;
const arrowBack = document.querySelector(".arrow-back");
const arrowForward = document.querySelector(".arrow-forward");

arrowBack.addEventListener("click", () => {
  currentPage--;
  pageNumber.innerHTML = currentPage;
  arrowForward.style.display = "block";
  if (currentPage === 1) {
    arrowBack.style.display = "none";
  }
  const url = `/wp-json/wp/v2/product/?per_page=9&page=${currentPage}${currentCategory != "" ? `&categories=${currentCategory}` : ""}${currentTag != "" ? `&tags=${currentTag}` : ""}`;
  //make API request
  axios.get(url).then(response => {
    clearProducts();
    for (const product of response.data) {
      createProduct(product);
    }
  });
});

arrowForward.addEventListener("click", () => {
  currentPage++;
  pageNumber.innerHTML = currentPage;
  arrowBack.style.display = "block";
  const url = `/wp-json/wp/v2/product/?per_page=9&page=${currentPage}${currentCategory != "" ? `&categories=${currentCategory}` : ""}${currentTag != "" ? `&tags=${currentTag}` : ""}`;
  //make API request
  axios
    .get(url)
    .then(response => {
      clearProducts();
      if (response.data.length < 9) {
        arrowForward.style.display = "none";
      }
      for (const product of response.data) {
        createProduct(product);
      }
    })
    .catch(error => {
      arrowForward.style.display = "none";
      console.log(error);
    });
});
