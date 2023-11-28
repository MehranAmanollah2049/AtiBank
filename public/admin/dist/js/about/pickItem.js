
let ItemCon = document.querySelectorAll(".ItemCon");
let submitBtn2 = document.querySelector(".submitBtn2");
let selectType = document.querySelector(".selectType");
let error2 = document.querySelector(".error2")

let intItem = document.querySelectorAll(".ItemCon.titleCon input");
let textInt = document.querySelectorAll(".ItemCon.textCon textarea");
let imgInt = document.querySelector(".ItemCon.imgCon input");


submitBtn2.addEventListener("click", () => {

    if (selectType.value == '') {

        submitBtn2.type = "button";
        error2.innerHTML = 'لطفا نوع آیتم را مشخص کنید'
    }

    if (selectType.value == "عنوان" && intItem[0].value == '' || intItem[1].value == '' || intItem[2].value == '') {

        submitBtn2.type = "button";
        error2.innerHTML = 'لطفا عنوان را وارد کنید'
    }
     if (selectType.value == "متن" && textInt[0].value == '' || textInt[1].value == '' || textInt[2].value == '') {

        submitBtn2.type = "button";
        error2.innerHTML = 'لطفا متن را وارد کنید'
    }
     if (selectType.value == "عکس" && imgInt.value == '') {

        submitBtn2.type = "button";
        error2.innerHTML = 'لطفا عکس را آپلود کنید'
    }


    if (selectType.value == "عنوان" && intItem[0].value != '' && intItem[1].value != '' && intItem[2].value != '') {

        submitBtn2.type = "submit";
        error2.innerHTML = ''
    }
     if (selectType.value == "متن" && textInt[0].value != '' && textInt[1].value != '' && textInt[2].value != '') {

        submitBtn2.type = "submit";
        error2.innerHTML = ''
    }
     if (selectType.value == "عکس" && imgInt.value != '') {

        submitBtn2.type = "submit";
        error2.innerHTML = ''
    }
})


selectType.addEventListener("change" , () => {


    removeAllItemCon();
    error2.innerHTML = ''

    if(selectType.value == "عنوان") {

        ItemCon[0].classList.add("active")

        textInt.forEach(textInt => {

            textInt.value = ""
        })
    }
    else if(selectType.value == "متن") {

        ItemCon[1].classList.add("active")

        intItem.forEach(intItem => {

            intItem.value = ""
        })
    }
    else {

        ItemCon[2].classList.add("active")

        imgInt.value = "";
    }



})

window.addEventListener("load" , () =>{

    removeAllItemCon()

    if(selectType.value == 'عنوان') {

        ItemCon[0].classList.add("active")
    }
    else if(selectType.value == 'متن') {

        ItemCon[1].classList.add("active")
    }
    else {

        ItemCon[2].classList.add("active")
    }
})


function removeAllItemCon() {

    ItemCon.forEach(ItemCon => {

        ItemCon.classList.remove("active")
    })

}