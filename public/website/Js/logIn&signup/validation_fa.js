
let ints = document.querySelectorAll("form .ints input");
let btnSubmit = document.querySelector(".SignUp_right form button");
let drps_title_validate = document.querySelectorAll(".drp_btn span")
let city_id = document.querySelector("#city_id");

let Numbers_char = /[0-9]/g;
let capital_chars = /[A-Z]/g;
let normal_chars = /[a-z]/g;
let other_chars = /[-!$%^&*()_+|~=`{}\[\]:\/;<>?,.@#]/;


btnSubmit.addEventListener("click", () => {


  if (ints[0].value == "" || ints[1].value == "" || ints[2].value == "" || ints[3].value == "" || ints[4].value == "" || drps_title_validate[0].innerHTML == "انتخاب کنید" || drps_title_validate[1].innerHTML == "انتخاب کنید" || drps_title_validate[2].innerHTML == "انتخاب کنید" || city_id.value == "") {

    Swal.fire({

      icon: 'error',
      title: 'لطفا اطلاعات خواسته شده را کامل کنید',
      toast: true,
      timer: 5000,
      timerProgressBar: true,
      customClass: {
        container: 'swal2-toast',
      }
    })
    btnSubmit.type = 'button';

  }
  else if (ints[0].value.length > 20) {

    Swal.fire({

      icon: 'error',
      title: 'طول فیلد نام نمی تواند بیشتر  از 20 کاراکتر باشد',
      toast: true,
      timer: 5000,
      timerProgressBar: true,
      customClass: {
        container: 'swal2-toast',
      }
    })
    btnSubmit.type = 'button';
  }
  else if (ints[1].value.length > 20) {

    Swal.fire({

      icon: 'error',
      title: 'طول فیلد نام خانوادگی نمی تواند بیشتر  از 20 کاراکتر باشد',
      toast: true,
      timer: 5000,
      timerProgressBar: true,
      customClass: {
        container: 'swal2-toast',
      }
    })
    btnSubmit.type = 'button';
  }
  else if (ints[2].value.length < 10) {

    Swal.fire({

      icon: 'error',
      title: 'لطفا یک شماره موبایل معتبر وارد کنید',
      toast: true,
      timer: 5000,
      timerProgressBar: true,
      customClass: {
        container: 'swal2-toast',
      }
    })
    btnSubmit.type = 'button';
  }
  else if (ints[3].value.length == 1) {

    Swal.fire({

      icon: 'error',
      title: 'لطفا کد کشور خود را وارد کنید',
      toast: true,
      timer: 5000,
      timerProgressBar: true,
      customClass: {
        container: 'swal2-toast',
      }
    })
    btnSubmit.type = 'button';
  }
  else if (ints[4].value.length < 8) {

    Swal.fire({

      icon: 'error',
      title: 'طول فیلد پسورد نمی تواند کمتر  از 8 کاراکتر باشد',
      toast: true,
      timer: 5000,
      timerProgressBar: true,
      customClass: {
        container: 'swal2-toast',
      }
    })
    btnSubmit.type = 'button';
  }
  else if ((!ints[4].value.match(Numbers_char) || !ints[4].value.match(capital_chars) || !ints[4].value.match(normal_chars)) && !ints[4].value.match(other_chars)) {

    Swal.fire({

      icon: 'error',
      title: 'پسورد شما حداقل باید دارای حروف کوچک و بزرگ و اعداد باشد',
      toast: true,
      timer: 8000,
      timerProgressBar: true,
      customClass: {
        container: 'swal2-toast',
      }
    })
    btnSubmit.type = 'button';
  }
  else {

    btnSubmit.type = 'submit';
  }

})

window.addEventListener("load" , () => {

  if(drps_title_validate[0].innerHTML == "انتخاب کنید" || drps_title_validate[1].innerHTML == "انتخاب کنید" || drps_title_validate[2].innerHTML == "انتخاب کنید") {

    document.querySelector("#city_id").value = "";

  }
})



