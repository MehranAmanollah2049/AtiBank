// hide and unide password
let pas_eye = document.querySelector(".ints.pas ion-icon");
let pas_int = document.querySelector(".ints.pas input");
let Phone_int = document.querySelector(".ints.phone .right input");

if (pas_eye != null) {

    pas_eye.addEventListener("click", () => {

        if (pas_int.type == "password") {

            pas_int.type = 'text';
            pas_eye.name = 'eye-off-outline';
        }
        else {

            pas_int.type = 'password';
            pas_eye.name = 'eye-outline';
        }
    })
}

// phone digits

let phone_code = document.querySelector("#Number_code");


phone_code.addEventListener("keydown", (e) => {

    if (e.key == "Backspace") {

        if (phone_code.value.length == 1) {

            e.preventDefault()
        }
    }
    else if (phone_code.value.length > 4) {

        e.preventDefault()
    }
    else if (phone_code.value[0] != "+") {

        phone_code.value = '+' + phone_code.value;
    }

})


Phone_int.addEventListener("keypress", (e) => {

    let charCode = (e.which) ? e.which : e.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {

        e.preventDefault();
    }

})

phone_code.addEventListener("keypress", (e) => {

    let charCode = (e.which) ? e.which : e.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {

        e.preventDefault();
    }

})

Phone_int.addEventListener("input", () => {

    if (Phone_int.value[0] == "0") {

        Phone_int.value = Phone_int.value.substr(1, Phone_int.length)
    }

})

