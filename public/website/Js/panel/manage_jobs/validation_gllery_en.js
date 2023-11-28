
let int = document.querySelectorAll(".add_Job_from input");
let btn = document.querySelector(".submitBtn")

btn.addEventListener("click" , () => {

    if(int[0].value == "" || int[1].value == "" || int[2].value == "" || int[3].value == "") {

        btn.type = "button"
        Swal.fire({

            icon: 'error',
            title: "Please complete the information",
            toast: true,
            timer: 5000,
            timerProgressBar: true,
            customClass: {
                container: 'swal2-toast',
            }
        })
    }
    else {

        btn.type = "submit"
    }
})