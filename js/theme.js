import axios from "axios";

const SINGLE_CATEGORY_ARRAY = document.querySelectorAll(".produkty__category");
const SINGLE_TAG_ARRAY = document.querySelectorAll(".produkty__tag");
const PRODUCTS_DIV = document.querySelector(".produkty__list");
let pageNumber = document.querySelector(".num");
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
  const productDiv = document.createElement("li");
  productDiv.setAttribute("class", "produkty__item");
  productDiv.dataset.title=product.title.rendered;

  const container = document.createElement("div");
  container.setAttribute("class", "container");
  productDiv.appendChild(container);
  //prepare and append product image
  const image = document.createElement("img");
  image.setAttribute("src", productImage);
  image.setAttribute("alt", "zdjęcie kartki");
  container.appendChild(image);

  const overlay = document.createElement("div");
  overlay.setAttribute("class", "overlay");
  container.appendChild(overlay);

  const divText = document.createElement("div");
  divText.setAttribute("class", "produkty__text");
  const text = document.createTextNode("Zobacz");
  divText.appendChild(text);
  overlay.appendChild(divText);
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
        arrowForward.style.visibility='none';
      }else{
        arrowForward.style.visibility='block';
      }
      clearProducts();
      currentCategory = requestedCategory;
      currentTag = requestedTag;
      currentPage = 1;
      pageNumber.innerHTML = currentPage;
      arrowBack.style.visibility = "hidden";
      for (const product of response.data) {
        createProduct(product);
      }
      screenTest(mql);
    });
    const nextUrl = `/wp-json/wp/v2/product/?per_page=9&page=2${requestedCategory != "" ? `&categories=${requestedCategory}` : ""}${requestedTag != "" ? `&tags=${requestedTag}` : ""}`;
        axios.get(nextUrl).then(data=>{
      arrowForward.style.visibility = "visible";
    }).catch(error => {
        arrowForward.style.visibility = "hidden";
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
        arrowForward.style.visibility='none';
      }else{
        arrowForward.style.visibility='block';
      }
      clearProducts();
      currentCategory = requestedCategory;
      currentTag = "";
      currentPage = 1;
      pageNumber.innerHTML = currentPage;
      arrowBack.style.visibility = "hidden";
      for (const product of response.data) {
        createProduct(product);
      }
      screenTest(mql);
    });
    const nextUrl = `/wp-json/wp/v2/product/?per_page=9&page=2${requestedCategory != "" ? `&categories=${requestedCategory}` : ""}`;
    axios.get(nextUrl).then(data=>{
      arrowForward.style.visibility = "visible";
    }).catch(error => {
        arrowForward.style.visibility = "hidden";
    });
  });
  
}

let currentPage = 1;
pageNumber.innerHTML = currentPage;
const arrowBack = document.querySelector(".arrow-back");
const arrowForward = document.querySelector(".arrow-forward");

arrowBack.addEventListener("click", () => {
  currentPage--;
  pageNumber.innerHTML = currentPage;
  arrowForward.style.visibility = "visible";
  if (currentPage === 1) {
    arrowBack.style.visibility = "hidden";
  }
  const url = `/wp-json/wp/v2/product/?per_page=9&page=${currentPage}${currentCategory != "" ? `&categories=${currentCategory}` : ""}${currentTag != "" ? `&tags=${currentTag}` : ""}`;
  //make API request
  axios.get(url).then(response => {
    clearProducts();
    for (const product of response.data) {
      createProduct(product);
    }
    screenTest(mql);
  });
});

arrowForward.addEventListener("click", () => {
  currentPage++;
  pageNumber.innerHTML = currentPage;
  arrowBack.style.visibility = "visible";
  const url = `/wp-json/wp/v2/product/?per_page=9&page=${currentPage}${currentCategory != "" ? `&categories=${currentCategory}` : ""}${currentTag != "" ? `&tags=${currentTag}` : ""}`;
  //make API request
  axios
    .get(url)
    .then(response => {
      clearProducts();
      if (response.data.length < 9) {
        arrowForward.style.visibility = "hidden";
      }
      for (const product of response.data) {
        createProduct(product);
      }
      screenTest(mql);
    })
    .catch(error => {
      arrowForward.style.visibility = "hidden";
      console.log(error);
    });

  const nextUrl = `/wp-json/wp/v2/product/?per_page=9&page=${currentPage+1}${currentCategory != "" ? `&categories=${currentCategory}` : ""}${currentTag != "" ? `&tags=${currentTag}` : ""}`;
  axios.get(nextUrl).catch(error => {
      arrowForward.style.visibility = "hidden";
  });
});


const hideNavbar = (body, header, list, icon, icon1, nav, logo) => {
    body.style.overflow = "visible";
    header.classList.remove("header--menu");
    list.classList.remove("nav--menu");
    icon.classList.add("icon--no");
    icon1.classList.remove("icon--no");
    nav.classList.add("nav--no");
    logo.style.display = "flex";
}

const navbar = () => {
    let icon = document.querySelector('.icon2');
    let icon2 = icon.classList.contains("icon--no");
    let header = document.querySelector("header");
    let list = document.querySelector('.nav__list');
    let icon1 = document.querySelector('.icon1');
    let body = document.querySelector("body");
    let nav = document.querySelector(".nav");
    let logo = document.querySelector(".logo");

    if (icon2 === true) {
        body.style.overflow = "hidden";
        header.classList.add("header--menu");
        list.classList.add("nav--menu");
        icon.classList.remove("icon--no");
        icon1.classList.add("icon--no");
        nav.classList.remove("nav--no");
        logo.style.display = "none";
    } else {
        hideNavbar(body, header, list, icon, icon1, nav, logo);
    }
}
let navIcon = document.querySelector(".nav__icon");
navIcon.addEventListener("click", navbar, false);

const removeOverflow = () => {
    let icon = document.querySelector('.icon2');
    let header = document.querySelector("header");
    let list = document.querySelector('.nav__list');
    let icon1 = document.querySelector('.icon1');
    let nav = document.querySelector(".nav");
    let logo = document.querySelector(".logo");
    let body = document.querySelector("body");
    hideNavbar(body, header, list, icon, icon1, nav, logo);
}

let navList = document.querySelectorAll(".nav__link");
for (const singleNavList of navList) {
    singleNavList.addEventListener("click", removeOverflow, false);
}
const openModal = (event) => {
    let modal = document.querySelector(".modal");
    const container = event.target.closest('.produkty__item');
    const price = container.querySelector('.produkty__price').innerText;
    let numer = container.querySelector('.produkty__nr').innerText;
    numer = numer.slice(3);
    const img = container.querySelector('img').src;
    const modalPrice = document.querySelector(".modal__price");
    modalPrice.innerText = "CENA: " + price;
    const modalNumer = modal.querySelector(".modal__numer");
    modalNumer.innerText = "NUMER KARTKI: " + numer;
    const modalImg = modal.querySelector(".pic");
    modalImg.src = img;
    modal.style.display = "flex";
    const title = container.dataset.title;
    const modalTitle = modal.querySelector("h2");
    modalTitle.innerHTML = title;
    let body = document.querySelector("body");
    body.style.overflow = "hidden";
    let background = document.querySelector(".background");
    background.style.display = "block";
}
const closeModal = () => {
    let modal = document.querySelector(".modal");
    modal.style.display = "none";
    let body = document.querySelector("body");
    body.style.overflow = "visible";
    let background = document.querySelector(".background");
    background.style.display = "none";
}

let a = document.querySelectorAll(".cross");
for (const singleOverlay of a) {
    singleOverlay.addEventListener("click", closeModal, false);
}
let background = document.querySelectorAll(".background");
for (const singleOverlay of background) {
    singleOverlay.addEventListener("click", closeModal, false);
}

var mql = window.matchMedia('(min-width: 672px)');

function screenTest(e) {
  if (e.matches) {
    let container = document.querySelectorAll(".container");
    for (const singleOverlay of container) {
    singleOverlay.addEventListener("click", openModal, false);
    }
    
  } else {
    let container = document.querySelectorAll(".container");
    for (const singleOverlay of container) {
    singleOverlay.removeEventListener("click", openModal, false);
    }
  }
}
screenTest(mql);
mql.addListener(screenTest);