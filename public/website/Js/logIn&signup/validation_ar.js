
let ints = document.querySelectorAll("form .ints input");
let btnSubmit = document.querySelector(".SignUp_right form button");
let drps_title_validate = document.querySelectorAll(".drp_btn span")
let city_id = document.querySelector("#city_id");

let Numbers_char = /[0-9]/g;
let capital_chars = /[A-Z]/g;
let normal_chars = /[a-z]/g;
let other_chars = /[-!$%^&*()_+|~=`{}\[\]:\/;<>?,.@#]/;


btnSubmit.addEventListener("click", () => {


  if (ints[0].value == "" || ints[1].value == "" || ints[2].value == "" || ints[3].value == "" || ints[4].value == "" || drps_title_validate[0].innerHTML == "يختار" || drps_title_validate[1].innerHTML == "يختار" || drps_title_validate[2].innerHTML == "يختار" || city_id.value == "") {

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
  else if (ints[0].value.length > 10) {

    Swal.fire({

      icon: 'error',
      title: 'لا يمكن أن يكون حقل الاسم أطول من 10 أحرف',
      toast: true,
      timer: 5000,
      timerProgressBar: true,
      customClass: {
        container: 'swal2-toast',
      }
    })
    btnSubmit.type = 'button';
  }
  else if (ints[1].value.length > 10) {

    Swal.fire({

      icon: 'error',
      title: 'لا يمكن أن يتجاوز طول حقل الاسم الأخير 10 أحرف',
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
  else if (ints[3].value.length == 1) {

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
  else if (ints[4].value.length < 8) {

    Swal.fire({

      icon: 'error',
      title: 'لا يمكن أن يكون طول حقل كلمة المرور أقل من 8 أحرف',
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
      title: 'يجب أن تحتوي كلمة مرورك على أحرف كبيرة وصغيرة وأرقام على الأقل',
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



