
let like_num = document.querySelectorAll(".like_num");
let loadingConn2 = document.querySelector(".loadingCon");
let favorites_num = document.querySelector(".favorites_num")
let favXS_num = document.querySelector(".favXS_num")

for (let i = 0; i < like_num.length; i++) {

    like_num[i].addEventListener("click", () => {

        loadingConn2.classList.add("active")

        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                loadingConn2.classList.remove("active")
                let result = this.responseText.split("|");

                if (result.length == 1) {

                    Swal.fire({

                        icon: 'error',
                        title: result[0],
                        toast: true,
                        timer: 5000,
                        timerProgressBar: true,
                        customClass: {
                            container: 'swal2-toast',
                        }
                    })
                }
                else {

                    if(result[1] == "liked") {

                        like_num[i].classList.add("liked");
                    }
                    else {

                        like_num[i].classList.remove("liked");
                    }

                    if(favorites_num != null) {

                        favorites_num.innerHTML = result[3]
                    }

                    if(favXS_num != null) {

                        favXS_num.innerHTML = result[3]
                    }

                    like_num[i].innerHTML = `<svg class='ml-1 -mt-0.5' width='13' height='11' viewBox='0 0 13 11' xmlns='http://www.w3.org/2000/svg'><path stroke='currentColor' d='M3.95035 1.229C4.81955 1.229 5.61243 1.66166 6.21284 2.15457C6.81326 1.66166 7.60614 1.229 8.47534 1.229C10.3497 1.229 11.8691 2.62275 11.8691 4.34192C11.8691 7.80824 7.92382 9.82702 6.62321 10.3984C6.36123 10.5134 6.06445 10.5134 5.80248 10.3984C4.50187 9.827 0.556602 7.80816 0.556602 4.34184C0.556602 2.62267 2.07603 1.229 3.95035 1.229Z' stroke-width='0.761705'></path></svg>${result[0]}`;

                    Swal.fire({

                        icon: 'success',
                        title: result[2],
                        toast: true,
                        timer: 5000,
                        timerProgressBar: true,
                        customClass: {
                            container: 'swal2-toast',
                        }
                    })
                }

            }
        }
        xml.open("GET", "/add_like_to_job/" + like_num[i].getAttribute("data-id"));
        xml.send();
    })
}