let deleteBtn = document.querySelectorAll(".deleteBtn");
let deleteBtnUser = document.querySelectorAll(".deleteBtnUser")

if (deleteBtn != null) {

    for (let i = 0; i < deleteBtn.length; i++) {

        deleteBtn[i].addEventListener("click", (e) => {

            e.preventDefault()
            let form = deleteBtn[i].parentElement;

            new swal({
                title: "آیا از حذف این آیتم اطمینان دارید؟",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'بله مطمئنم',
                cancelButtonText: 'انصراف',
                dangerMode: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });

        });
    }
}

if (deleteBtnUser != null) {

    for (let i = 0; i < deleteBtnUser.length; i++) {

        deleteBtnUser[i].addEventListener("click", (e) => {

            e.preventDefault()
            let form = deleteBtnUser[i].parentElement;
            let status = form.querySelector(".status").value;
            let userId = form.querySelector(".userId").value;

            if (status != "no") {

                new swal({
                    title: "آیا از حذف این کابر اطمینان دارید؟",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: 'بله مطمئنم',
                    cancelButtonText: 'انصراف',
                    dangerMode: true,
                }).then((result) => {

                    if (result.isConfirmed) {
                        new swal({
                            title: "آیا میخواهید که شغل های مربوطه به این کاربر هم حذف شوند؟",
                            icon: "warning",
                            showDenyButton: true,
                            showCancelButton: false,
                            confirmButtonText: 'بله حذف شه',
                            denyButtonText: `نه حذف نشه`,
                        }).then((result2) => {
                            if (result2.isConfirmed) {
                                form.setAttribute("action", `/admin/user/${userId}/delete/yes`)
                                form.submit();
                            }
                            else if (result2.isDenied) {

                                form.setAttribute("action", `/admin/user/${userId}/delete/no`)
                                form.submit();
                            }


                        });
                    }
                });
            }
            else {

                new swal({
                    title: "آیا از حذف این کابر اطمینان دارید؟",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: 'بله مطمئنم',
                    cancelButtonText: 'انصراف',
                    dangerMode: true,
                }).then((result) => {

                    if (result.isConfirmed) {

                        form.setAttribute("action", `/admin/user/${userId}/delete/no`)
                        form.submit();
                    }
                });
            }

        });
    }
}
