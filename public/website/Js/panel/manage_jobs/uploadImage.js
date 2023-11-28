
let uploader = document.querySelector(".uploadPlace");
let uploader_label = document.querySelector(".uploadPlace label");
let input = document.querySelector("#file")
let deleteUploadedFileCon = document.querySelector(".deleteUploadedFileCon")

uploader.addEventListener("dragover", (e) => {

    e.preventDefault();
    e.stopPropagation();
    uploader.classList.add("leave")
    uploader.classList.remove("uploaded")
})

uploader.addEventListener("dragleave", (e) => {

    e.preventDefault();
    e.stopPropagation();
    uploader.classList.remove("leave")
    uploader.classList.remove("uploaded")
})

uploader.addEventListener("drop", (e) => {

    e.preventDefault();
    e.stopPropagation();

    let draggedData = e.dataTransfer;
    let files = draggedData.files;

    let reader = new FileReader();
    reader.readAsDataURL(files[0]);
    reader.addEventListener("load" , () =>{

        uploader.classList.remove("leave");
        uploader.classList.add("uploaded")
        uploader_label.style.backgroundImage = `url(${reader.result})`
   
    })

}, false);


input.addEventListener("change", () => {

    let reader = new FileReader();

    reader.addEventListener("load", () => {

        uploader.classList.remove("leave");
        uploader.classList.add("uploaded")
        uploader_label.style.backgroundImage = `url(${reader.result})`
    });

    reader.readAsDataURL(input.files[0]);

})


deleteUploadedFileCon.addEventListener("click" , () => {

    uploader.classList.remove("leave");
    uploader.classList.remove("uploaded")
    uploader_label.style.backgroundImage = `url()`
})