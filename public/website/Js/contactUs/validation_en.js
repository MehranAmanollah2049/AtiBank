
let ints  = document.querySelectorAll(".contact_us_form input");
let ints2  = document.querySelector(".contact_us_form textarea");
let btn_contact = document.querySelector(".btn_contact");

btn_contact.addEventListener("click" , () => {

    if(ints[0].value == '' || ints[1].value == '' || ints[2].value == '' || ints[3].value == '' || ints2.value == '') {

        Swal.fire({

            icon: 'error',
            title: 'Please complete the requested information',
            toast: true,
            timer: 5000,
            timerProgressBar: true,
            customClass: {
              container: 'swal2-toast',
            }
          })
        btn_contact.type = 'button'; 
    }
    else if(!ints[2].value.includes("@gmail.com")) {

        Swal.fire({

            icon: 'error',
            title: 'Please enter a valid email',
            toast: true,
            timer: 5000,
            timerProgressBar: true,
            customClass: {
              container: 'swal2-toast',
            }
          })
        btn_contact.type = 'button'; 
    }
    else {

      btn_contact.type = 'submit'
    }
});

ints[3].addEventListener("keypress" , (e) => {

    if(ints[3].value[0] != '+') {

        ints[3].value += '+';
    }

    let charCode = (e.which) ? e.which : e.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {

        e.preventDefault();
    }

});

