require('./api');

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
        body.style.overflow = "visible";
        header.classList.remove("header--menu");
        list.classList.remove("nav--menu");
        icon.classList.add("icon--no");
        icon1.classList.remove("icon--no");
        nav.classList.add("nav--no");
        logo.style.display = "flex";
    }
}
let navIcon = document.querySelector(".nav__icon");
navIcon.addEventListener("click", navbar, false);