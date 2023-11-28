
let addComment_btn2 = document.querySelector(".CommentAdd_con.Answer .addComment_btn")
let CommentAdd_int2 = document.querySelector(".CommentAdd_con.Answer textarea");

addComment_btn2.addEventListener("click" , () => {

    if(CommentAdd_int2.value == '') {

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

        addComment_btn2.type = 'button';
    }
    else {

        addComment_btn2.type = 'submit';
    }
})