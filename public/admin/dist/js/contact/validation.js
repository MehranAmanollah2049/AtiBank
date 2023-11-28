
let submitBtn = document.querySelector(".submitBtn")
let ints = document.querySelectorAll("#Form_insert input");
let error = document.querySelector(".error")

submitBtn.addEventListener("click" , () => {

    if((ints[0].value != '' && ints[1].value == '' || ints[0].value == '' && ints[1].value != '') || (ints[2].value != '' && ints[3].value == '' || ints[2].value == '' && ints[3].value != '') || (ints[4].value != '' && ints[5].value == '' || ints[4].value == '' && ints[5].value != '') || (ints[7].value != '' && ints[8].value == '' && ints[9].value == '' || ints[7].value == '' && ints[8].value != '' && ints[9].value == '' || ints[7].value == '' && ints[8].value == '' && ints[9].value != '' || ints[7].value != '' && ints[8].value != '' && ints[9].value == '' || ints[7].value != '' && ints[8].value == '' && ints[9].value != '' || ints[7].value == '' && ints[8].value != '' && ints[9].value != '')) {

        error.innerHTML = 'لطفا اطلاعات ر به درستی وارد کنید'
        submitBtn.type = 'button'
    }
    else {

        submitBtn.type = 'submit';
        error.innerHTML = ''
    }
})