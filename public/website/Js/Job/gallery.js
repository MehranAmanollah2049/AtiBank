
let Gallery_con = document.querySelector(".Gallery_con");
let watch_gallery_btns = document.querySelector(".watch_gallery_btns");
let Gallery_shadow = document.querySelector(".Gallery_shadow")

watch_gallery_btns.addEventListener("click" , () => {

    Gallery_con.classList.add("active")
})

Gallery_shadow.addEventListener("click" , () => {

    Gallery_con.classList.remove("active")
})