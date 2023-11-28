
let ints = document.querySelectorAll("form .ints input");
let btnSubmit = document.querySelector(".SignUp_right form button");


btnSubmit.addEventListener("click", () => {


  if (ints[0].value == "" || ints[1].value == "") {

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
    btnSubmit.type = 'button';

  }
  else if (ints[0].value.length < 10) {

    Swal.fire({

      icon: 'error',
      title: 'Please enter a valid mobile number',
      toast: true,
      timer: 5000,
      timerProgressBar: true,
      customClass: {
        container: 'swal2-toast',
      }
    })
    btnSubmit.type = 'button';
  }
  else if (ints[1].value.length == 1) {

    Swal.fire({

      icon: 'error',
      title: 'Please enter your country code',
      toast: true,
      timer: 5000,
      timerProgressBar: true,
      customClass: {
        container: 'swal2-toast',
      }
    })
    btnSubmit.type = 'button';
  }
  else {

    btnSubmit.type = "submit";
  }

})





