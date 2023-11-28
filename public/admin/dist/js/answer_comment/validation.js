let ints = document.querySelector("#Form_insert textarea");
let error = document.querySelector(".error");
let submitBtn = document.querySelector(".submitBtn");

submitBtn.addEventListener("click", () => {


    if (ints.value == "") {

        submitBtn.type = "button";
        error.innerHTML = "لطفا اطلاعات را تکمیل کنید"
    }


    if (ints.value != "") {

        submitBtn.type = "submit";
        error.innerHTML = "";
    }
});