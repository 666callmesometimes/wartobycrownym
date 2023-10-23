const menu = document.querySelector("nav");
const menuBtn = document.querySelector(".burger");

menuBtn.addEventListener("click" , function() {
    menu.classList.toggle('off');
})