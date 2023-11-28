
let intPhone = document.querySelector(".ints_sec.phoneNum input");


intPhone.addEventListener("keydown" , (e) => {

    intPhone.setAttribute("readonly" , "");
    e.preventDefault();
})
