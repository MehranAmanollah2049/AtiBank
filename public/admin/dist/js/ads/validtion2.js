
let int = document.querySelector("#price");
let submitBtn = document.querySelector(".submitBtn");

submitBtn.addEventListener("click", () => {


    if (int.value.length == 0) {

        submitBtn.type = "button";
        error.innerHTML = "لطفا اطلاعات را تکمیل کنید"
    }

    if (int.value.length != 0) {

        submitBtn.type = "submit";
        error.innerHTML = "";
    }
});


int.addEventListener("keypress" , (e) =>{

    let ch = String.fromCharCode(e.which);

    if(!(/[0-9]/.test(ch))) {

        e.preventDefault();
    }

});

int.addEventListener("input" , (e) =>{

    if(int.value != "") {

        let val = parseInt(int.value.replace(/\D/g,""));
        int.value = val.toLocaleString();
    }

});