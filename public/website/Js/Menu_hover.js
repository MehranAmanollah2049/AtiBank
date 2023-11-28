
let line_under_menu = document.querySelector(".line_under_menu");
let menu_lis = document.querySelectorAll(".right_menu_sec ul li");
let menu_ul = document.querySelectorAll(".right_menu_sec ul");


for(let i =0;i<menu_lis.length;i++) {

    menu_lis[i].addEventListener("mouseover" , () =>{

        removeAll_line_actives();
        line_under_menu.classList.add("show");
        line_under_menu.classList.add("active" + i)
        line_under_menu.style.width = menu_lis[i].clientWidth + 'px';
    })

    menu_lis[i].addEventListener("mouseleave" , () =>{

        line_under_menu.classList.remove("show");
    })
}

function removeAll_line_actives() {

    for(let i =0;i<menu_lis.length;i++) {

        line_under_menu.classList.remove("active" + i);
    }
}