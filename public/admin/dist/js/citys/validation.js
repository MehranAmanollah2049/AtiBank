
let ints = document.querySelectorAll("#Form_insert input");
let select = document.querySelectorAll("#Form_insert select")
let error = document.querySelector(".error");
let submitBtn = document.querySelector(".submitBtn");

submitBtn.addEventListener("click", () => {


    if (ints[0].value == "" || ints[1].value == "" || ints[2].value == "" || select[0].value == "انتخاب کنید" || select[1].value == "انتخاب کنید") {

        submitBtn.type = "button";
        error.innerHTML = "لطفا اطلاعات را تکمیل کنید"
    }


    if (ints[0].value != "" && ints[1].value != "" && ints[2].value != "" && select[0].value != "انتخاب کنید" && select[1].value != "انتخاب کنید") {

        submitBtn.type = "submit";
        error.innerHTML = "";
    }
});