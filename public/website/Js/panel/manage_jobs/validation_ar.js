



let ints = document.querySelectorAll(".add_Job_from input");
let select = document.querySelectorAll(".add_Job_from select")
let submitBtn = document.querySelector(".submitBtn");
let textarea = document.querySelectorAll(".add_Job_from textarea")

submitBtn.addEventListener("click", () => {


    if (ints[0].value == "" || ints[1].value == "" || ints[2].value == "" || ints[3].value == "" || ints[4].value == "" || ints[5].value == "" || ints[6].value == "" || ints[7].value.length == "+" || ints[8].value == "" || ints[9].value == "" || ints[10].value == "" || ints[11].value == "" || ints[12].value == "" || ints[13].value == "" || ints[17].value == "" || ints[18].value == "" || ints[19].value == "" || select[0].value == "" || select[1].value == "" || select[2].value == "" || select[3].value == "" || select[4].value == "" || textarea[0].value == "" || textarea[1].value == "" || textarea[2].value == "") {

        submitBtn.type = "button";
        Swal.fire({

            icon: 'error',
            title: "يرجى استكمال المعلومات",
            toast: true,
            timer: 5000,
            timerProgressBar: true,
            customClass: {
                container: 'swal2-toast',
            }
        })
    }
    else if(ints[7].value.length <= 11) {

        submitBtn.type = "button";
        Swal.fire({

            icon: 'error',
            title: "الرجاء إدخال رقم جوال صحيح",
            toast: true,
            timer: 5000,
            timerProgressBar: true,
            customClass: {
                container: 'swal2-toast',
            }
        })
    }


    if (ints[0].value != "" && ints[1].value != "" && ints[2].value != "" && ints[3].value != "" && ints[4].value != "" && ints[5].value != "" && ints[6].value != "" && ints[7].value.length >= 11 && ints[8].value != "" && ints[9].value != "" && ints[10].value != "" && ints[11].value != "" && ints[12].value != "" && ints[13].value != ""  && ints[17].value != "" && ints[18].value != "" && ints[19].value != "" && select[0].value != "" && select[1].value != "" && select[2].value != "" && select[3].value != "" && select[4].value != "انتخاب کنید" && textarea[0].value != "" && textarea[1].value != "" && textarea[2].value != "") {

        submitBtn.type = "submit";
        error.innerHTML = "";
    }
});

