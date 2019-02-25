import axios from 'axios';
const documentTags = document.querySelectorAll('.produkty__tag');
const productsContainer = document.querySelector('.produkty__list');

for (const documentTag of documentTags) {
  documentTag.addEventListener('click', () => {
    
    for (const tag of documentTags) {
      tag.classList.remove('active');      
    }
    documentTag.classList.add('active');
    const category = documentTag.dataset.category;
    const tag = documentTag.dataset.tag;
    const url = `/wp-json/wp/v2/product/?per_page=9&page=1&categories=${category}&tags=${tag}`;
    axios.get(url).then(response => {
      while (productsContainer.firstChild) {
        productsContainer.removeChild(productsContainer.firstChild);
      }
      for (const item of response.data) {
        const productDiv = document.createElement('div');
        productDiv.setAttribute('class','produkty__item')

        const image = document.createElement('img');
        image.setAttribute('src', item.cmb2.product.image);
        image.setAttribute('alt', 'zdjęcie kartki');
        image.setAttribute('width', '100px');
        image.setAttribute('height', '100px');
        productDiv.appendChild(image);

        const id = document.createTextNode(item.id);
        const idElement = document.createElement('p');
        idElement.appendChild(id);
        productDiv.appendChild(idElement);

        const price = document.createTextNode(item.cmb2.product.price + ' zł');
        const priceElement = document.createElement('p');
        priceElement.appendChild(price);
        productDiv.appendChild(priceElement);

        productsContainer.appendChild(productDiv);
      }
    });
  });
}

const documentCategories = document.querySelectorAll('.produkty__category');

for (const documentCategory of documentCategories) {
  documentCategory.addEventListener('click', () => {
    const category = documentCategory.dataset.category;
    const tag = documentCategory.dataset.tag;
    const url = `/wp-json/wp/v2/product/?per_page=9&page=1&categories=${category}`;
    axios.get(url).then(response => {
      while (productsContainer.firstChild) {
        productsContainer.removeChild(productsContainer.firstChild);
      }
      for (const item of response.data) {
        const productDiv = document.createElement('div');
        productDiv.setAttribute('class','produkty__item')

        const image = document.createElement('img');
        image.setAttribute('src', item.cmb2.product.image);
        image.setAttribute('alt', 'zdjęcie kartki');
        image.setAttribute('width', '100px');
        image.setAttribute('height', '100px');
        productDiv.appendChild(image);

        const id = document.createTextNode(item.id);
        const idElement = document.createElement('p');
        idElement.appendChild(id);
        productDiv.appendChild(idElement);

        const price = document.createTextNode(item.cmb2.product.price + ' zł');
        const priceElement = document.createElement('p');
        priceElement.appendChild(price);
        productDiv.appendChild(priceElement);

        productsContainer.appendChild(productDiv);
      }
    });
  });
  documentCategory.addEventListener('click',()=>{
    for (const category of documentCategories) {
      category.classList.remove('active');      
    }
    for (const tag of documentTags) {
      tag.classList.remove('active');      
    }
    documentCategory.classList.add('active');
    for (const documentTag of documentTags) {
        documentTag.parentElement.classList.remove('active');
      }  
    for (const documentTag of documentTags) {
      if(documentTag.dataset.category==documentCategory.dataset.category){
        documentTag.parentElement.classList.add('active');
        break;
      }  
    }
  })
}
