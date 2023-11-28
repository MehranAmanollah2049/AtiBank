
let langXSBtn = document.querySelector(".langXSBtn");
let langDrpAll = document.querySelector(".langDrpAll");
let langDrp = document.querySelector(".langDrp");

langXSBtn.addEventListener("click" , () => {

    
    if(!langXSBtn.classList.contains("active")) {

        langDrpAll.style.height = langDrp.clientHeight + 'px';
    }
    else {
        
        langDrpAll.style.height =  '0px';
    }
    langXSBtn.classList.toggle("active");
})


let MenuXSbTN = document.querySelector(".MenuXSbTN");
let MenuXS_Shadow = document.querySelector(".MenuXS_Shadow");
let MenuXSBar_con = document.querySelector(".MenuXSBar_con")

MenuXSbTN.addEventListener("click" , () => {

   

    MenuXSbTN.classList.toggle("active")
    MenuXS_Shadow.classList.toggle("active")
    MenuXSBar_con.classList.toggle("active")
    
    if(MenuXSbTN.classList.contains("active")) {

        document.documentElement.classList.add("hidden")
    }
    else {

        document.documentElement.classList.remove("hidden")
    }

})