let ints = document.querySelectorAll("#Form_insert input");
let select = document.querySelectorAll("#Form_insert select")
let error = document.querySelector(".error");
let submitBtn = document.querySelector(".submitBtn");
let textarea = document.querySelectorAll("#Form_insert textarea")

submitBtn.addEventListener("click", () => {


    if (ints[0].value == "" || ints[1].value == "" || ints[2].value == "" || ints[3].value == "" || ints[4].value == "" || ints[5].value == "" || ints[6].value == "" || ints[7].value == "" || ints[8].value == "" || ints[9].value == "" || ints[10].value == "" || ints[11].value == "" || ints[12].value == "" || ints[13].value == "" || ints[17].value == "" || ints[18].value == "" || ints[23].value == "" || select[0].value == "انتخاب کنید" || select[1].value == "انتخاب کنید" || select[2].value == "انتخاب کنید" || select[3].value == "انتخاب کنید" || select[4].value == "انتخاب کنید" || textarea[0].value == "" || textarea[1].value == "" || textarea[2].value == "") {

        submitBtn.type = "button";
        error.innerHTML = "لطفا اطلاعات را تکمیل کنید"
    }
    else if(ints[6].value.length != 11) {
     
        submitBtn.type = "button";
        error.innerHTML = "لطفا یک شماره موبایل معتبر وارد کنید"
        
    }
    

    if (ints[0].value != "" && ints[1].value != "" && ints[2].value != "" && ints[3].value != "" && ints[4].value != "" && ints[5].value != "" && ints[6].value != "" && ints[7].value != "" && ints[8].value != "" && ints[9].value != "" && ints[10].value != "" && ints[11].value != "" && ints[12].value != "" && ints[13].value != ""  && ints[17].value != "" && ints[18].value != "" && ints[23].value != "" && select[0].value != "انتخاب کنید" && select[1].value != "انتخاب کنید" && select[2].value != "انتخاب کنید" && select[3].value != "انتخاب کنید" && select[4].value != "انتخاب کنید" && textarea[0].value != "" && textarea[1].value != "" && textarea[2].value != "") {

        submitBtn.type = "submit";
        error.innerHTML = "";
    }
});

