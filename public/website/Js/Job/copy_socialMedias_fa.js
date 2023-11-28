
let socialMediasBoxs = document.querySelectorAll(".socialMediasBoxs");


for (let i = 0; i < socialMediasBoxs.length; i++) {

    socialMediasBoxs[i].addEventListener("click", () => {

        if (socialMediasBoxs[i].getAttribute("data-to-copy") != null) {

            navigator.clipboard.writeText(socialMediasBoxs[i].getAttribute("data-to-copy"));

            Swal.fire({

                icon: 'success',
                title: 'کپی شد',
                toast: true,
                timer: 5000,
                timerProgressBar: true,
                customClass: {
                    container: 'swal2-toast',
                }
            })

        }

    })
}