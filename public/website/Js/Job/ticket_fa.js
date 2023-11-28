
let addComment_btn3 = document.querySelector(".CommentAdd_con.Ticket .addComment_btn")
let CommentAdd_int3 = document.querySelector(".CommentAdd_con.Ticket textarea");

addComment_btn3.addEventListener("click" , () => {

    if(CommentAdd_int3.value == '') {

        Swal.fire({

            icon: 'error',
            title: 'لطفا متن مورد نظر خود را وارد کنید',
            toast: true,
            timer: 5000,
            timerProgressBar: true,
            customClass: {
                container: 'swal2-toast',
            }
        })

        addComment_btn3.type = 'button';
    }
    else {

        addComment_btn3.type = 'submit';
    }
})