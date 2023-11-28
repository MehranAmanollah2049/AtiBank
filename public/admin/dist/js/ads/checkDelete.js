let deleteBtn2 = document.querySelectorAll(".deleteBtn2");


for (let i = 0; i < deleteBtn2.length; i++) {

    deleteBtn2[i].addEventListener("click", (e) => {

        e.preventDefault()
        let form = deleteBtn2[i].parentElement;
        let AdsId = form.querySelector(".AdsId").value

        new swal({
            title: "آیا از لغو این تبلیغ اطمینان دارید؟",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: 'بله مطمئنم',
            cancelButtonText: 'انصراف',
            dangerMode: true,
        }).then((result) => {

            if (result.isConfirmed) {
                Swal.fire({
                    icon: "info",
                    title: 'دلیل حذف این تبلیغ را بنویسید تا برای کاربر پیامک شود',
                    input: 'text',
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'ارسال',
                    showLoaderOnConfirm: true,
                    cancelButtonText: 'انصراف',
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (result.value == '') {

                            form.setAttribute("action", `/admin/ads/${AdsId}/0/delete`)
                            form.submit();
                        }
                        else {

                            form.setAttribute("action", `/admin/ads/${AdsId}/${result.value}/delete`)
                            form.submit();
                        }
                    }
                })
            }
        });

    });
}