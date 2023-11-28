
let Right_container_all = document.querySelector(".Right_container_all")
let overlayMenuXS = document.querySelector(".overlayMenuXS")
let ExitMenuXSbTN = document.querySelector(".ExitMenuXSbTN")
let MenuBarXS = document.querySelector(".MenuBarXS");

MenuBarXS.addEventListener("click" , () => {

    Right_container_all.classList.add("active")
    overlayMenuXS.classList.add("active")
})

overlayMenuXS.addEventListener("click" , () => {

    Right_container_all.classList.remove("active")
    overlayMenuXS.classList.remove("active")
})

ExitMenuXSbTN.addEventListener("click" , () => {

    Right_container_all.classList.remove("active")
    overlayMenuXS.classList.remove("active")
})