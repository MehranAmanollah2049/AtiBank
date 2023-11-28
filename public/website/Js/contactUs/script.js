
let SeeMore = document.querySelector(".SeeMore")
let ContactWaysCon = document.querySelector(".ContactWaysCon");

SeeMore.addEventListener("click" , () => {

    document.documentElement.scrollTop = ContactWaysCon.offsetTop;
})