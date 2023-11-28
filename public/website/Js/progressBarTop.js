
let progressBarTop = document.querySelector(".progressBarTop");

window.addEventListener("scroll" , getProgress)
window.addEventListener("load" , getProgress)

function getProgress() {

    let scrollTop = document.documentElement.scrollTop;
    let scrollHeight = document.documentElement.scrollHeight;
    let Height = document.documentElement.clientHeight;

    let wtProgress = scrollTop / (scrollHeight - Height) * 100;

    progressBarTop.style.width = wtProgress + "%";

}