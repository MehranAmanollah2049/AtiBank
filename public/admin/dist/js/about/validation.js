
let submitBtn = document.querySelector(".submitBtn");
let int = document.querySelectorAll("#Form_Edit textarea");
let error = document.querySelector("#Form_Edit .error");

submitBtn.addEventListener("click" , () =>{

    if(int[0].value == "" || int[1].value == "" || int[2].value == "") {

        submitBtn.type = 'button';
        error.innerHTML = 'لطفا اطلاعات را کامل کنید'
    }
    else {

        submitBtn.type = 'submit';
        error.innerHTML = ''
    }
})