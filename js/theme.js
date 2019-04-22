require('./api');

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
const openModal = () => {
    let modal = document.querySelector(".modal");
    modal.style.display = "flex";
}
let container = document.querySelectorAll(".container");
for (const singleOverlay of container) {
    singleOverlay.addEventListener("click", openModal, false);
}
const closeModal = () => {
    let modal = document.querySelector(".modal");
    modal.style.display = "none";
}

let a = document.querySelectorAll(".cross");
for (const singleOverlay of a) {
    singleOverlay.addEventListener("click", closeModal, false);
}