let deleteBtn = document.querySelectorAll(".deleteBtn");

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


