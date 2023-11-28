
let showContactTextBtn = document.querySelectorAll(".showContactTextBtn");


for(let i =0;i<showContactTextBtn.length;i++) {

    showContactTextBtn[i].addEventListener("click" , () =>{

        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function () {
            if(this.readyState == 4 && this.status == 200) {
                
                document.querySelector(".modal-body p").innerHTML = this.responseText;
            }
        }
        xml.open("GET" , "/admin/GetCotactText/" + showContactTextBtn[i].getAttribute("data-id"));
        xml.send();

    });
}