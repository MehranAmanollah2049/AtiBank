
let ints = document.querySelectorAll("#Form_insert input");
let ints2 = document.querySelector("#Form_insert select");
let error = document.querySelector(".error");
let submitBtn = document.querySelector(".submitBtn");

submitBtn.addEventListener("click", () => {


    if (ints[0].value == "" || ints[1].value == "" || ints[2].value == ""  || ints[3].value == "" || ints[4].value == "" || ints[5].value == "" || ints2.value == 'انتخاب کنید') {

        submitBtn.type = "button";
        error.innerHTML = "لطفا اطلاعات را تکمیل کنید"
    }
    else if(ints[4].value == "0") {

        submitBtn.type = "button";
        error.innerHTML = "تاریخ انقضا باید حداقل 1 روز باشد"
    }


    if (ints[0].value != "" && ints[1].value != "" && ints[2].value != ""  && ints[3].value != "" && ints[4].value != "" && ints[4].value != "0" && ints[5].value != ""  && ints2.value != 'انتخاب کنید') {

        submitBtn.type = "submit";
        error.innerHTML = "";
    }
});


ints[4].addEventListener("keypress" , (e) =>{

    let ch = String.fromCharCode(e.which);

    if(!(/[0-9]/.test(ch))) {

        e.preventDefault();
    }

});