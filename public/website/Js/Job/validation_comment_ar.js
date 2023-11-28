
let addComment_btn = document.querySelector(".CommentAdd_con.Cmt .addComment_btn")
let CommentAdd_int = document.querySelector(".CommentAdd_con.Cmt textarea");

addComment_btn.addEventListener("click" , () => {

    if(CommentAdd_int.value == '') {

        Swal.fire({

            icon: 'error',
            title: 'الرجاء إدخال النص المطلوب',
            toast: true,
            timer: 5000,
            timerProgressBar: true,
            customClass: {
                container: 'swal2-toast',
            }
        })

        addComment_btn.type = 'button';
    }
    else {

        addComment_btn.type = 'submit';
    }
})