
let submitBtn  = document.querySelector(".submitBtn");
let ints = document.querySelectorAll("#Form_insert input");
let error = document.querySelector(".error");


submitBtn.addEventListener("click" , () =>{

    if(ints[0].value == "" || ints[1].value == "" || ints[2].value == "" ||  ints[3].value == "" || ints[4].value.length != 11) {

        error.innerHTML = "لطفا اطلاعات را به درستی وارد کنید";
        submitBtn.type = "button";
    }


    if(ints[0].value != "" && ints[1].value != "" && ints[2].value != "" &&  ints[3].value != "" && ints[4].value.length == 11) {

        error.innerHTML = "";
        submitBtn.type = "submit";
    }

})