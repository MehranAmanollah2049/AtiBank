
let ints2 = document.querySelectorAll("#Form_insert textarea");
let error = document.querySelector(".error");
let submitBtn = document.querySelector(".submitBtn");

submitBtn.addEventListener("click", () => {


    if (ints2[0].value == "" || ints2[1].value == "" || ints2[2].value == "") {

        submitBtn.type = "button";
        error.innerHTML = "لطفا اطلاعات را تکمیل کنید"
    }


    if (ints2[0].value != "" && ints2[1].value != "" && ints2[2].value != "") {

        submitBtn.type = "submit";
        error.innerHTML = "";
    }
});