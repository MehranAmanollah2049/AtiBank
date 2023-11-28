
let ints = document.querySelectorAll(".ints.confrim input");
let submitButton = document.querySelector("form button")
let resendCodeCon = document.querySelector(".resendCodeCon");
let timerText = document.querySelector(".resendCodeCon p");

let set;

function SetTimer(min,sec) {

    let minute = 0;
    let second = 0;

    set = setInterval(() => {

        if (sec <= 0) {

            if (min <= 0) {

                sec = 0;
                min = 0;
                clearInterval(set);
                resendCodeCon.classList.remove("timer")

            }
            else {

                sec = 60;
                min--;
            }
         
        }
        else {

            sec--;
        }

        


        if (min < 10) {

            minute = "0" + min;
        }
        else {

            minute = min;
        }
        if (sec < 10) {

            second = "0" + sec;
        }
        else {

            second = sec;
        }


        timerText.innerHTML = `Resend the verification code at ${minute}:${second}`;


    }, 1000);

}

SetTimer(1,0)

for (let i = 0; i < ints.length; i++) {

    ints[i].addEventListener("input", (e) => {

        ints[i].value = ints[i].value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '');

        if (ints[i].value.length > 0 && ints[i].value != "") {

            if (i < ints.length - 1) {

                ints[i + 1].focus();

            }
        }
    })

    ints[i].addEventListener("keydown", (e) => {

        
        if (e.key == "Backspace") {

            if (ints[ints.length - 1].value != "") {

                ints[ints.length - 1].focus();
            }
            else if (i > 0) {

                ints[i - 1].focus();
                ints[i - 1].value = '';

            }

        }




    })
}

ints.forEach(int => {


    int.addEventListener("input", (e) => {

        if (int.value.length > 1 && int.value != "") {

            int.value = int.value[0]
            e.preventDefault()
        }
    })


});
submitButton.addEventListener("click", () => {

    if (ints[0].value == "" || ints[1].value == "" || ints[2].value == "" || ints[3].value == "" || ints[4].value == "") {

        Swal.fire({

            icon: 'error',
            title: 'Please enter the code sent',
            toast: true,
            timer: 5000,
            timerProgressBar: true,
            customClass: {
                container: 'swal2-toast',
            }
        })
        submitButton.type = 'button';
    }
    else {

        submitButton.type = 'submit';
    }
})