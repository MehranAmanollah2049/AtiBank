
let ints = document.querySelectorAll("form .ints input");
let btnSubmit = document.querySelector(".SignUp_right form button");


btnSubmit.addEventListener("click", () => {


  if (ints[0].value == "" || ints[1].value == "") {

    Swal.fire({

      icon: 'error',
      title: 'يرجى استكمال المعلومات المطلوبة',
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
      title: 'الرجاء إدخال رقم جوال صحيح',
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
      title: 'الرجاء إدخال رمز بلدك',
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





