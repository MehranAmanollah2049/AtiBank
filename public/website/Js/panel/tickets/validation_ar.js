
let sendTicketBtn = document.querySelector(".sendTicketBtn");
let imageUploadSender = document.querySelector(".imageUploadSender");
let textsender = document.querySelector(".textsender")

let messaner_form2 = document.querySelector("#messaner_form")
let uploadedImageCon2 = document.querySelector(".uploadedImageCon");

sendTicketBtn.addEventListener("click" , () => {

    if(messaner_form2.getAttribute("data-type") == "insert") {

        if(textsender.value == "" && imageUploadSender.value == "") {

            Swal.fire({
    
                icon: 'error',
                title: 'الرجاء كتابة رسالة لإرسالها',
                toast: true,
                timer: 5000,
                timerProgressBar: true,
                customClass: {
                    container: 'swal2-toast',
                }
            })
        }
        
    }
    else {

        if(textsender.value == "" && !uploadedImageCon2.classList.contains("active")) {

            Swal.fire({
    
                icon: 'error',
                title: 'الرجاء كتابة رسالة لإرسالها',
                toast: true,
                timer: 5000,
                timerProgressBar: true,
                customClass: {
                    container: 'swal2-toast',
                }
            })
        }
    }
    


});