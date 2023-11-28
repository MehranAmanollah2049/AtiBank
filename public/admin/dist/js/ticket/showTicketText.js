
let showTicketTextBtn = document.querySelectorAll(".showTicketTextBtn")


for(let i =0;i<showTicketTextBtn.length;i++) {

    showTicketTextBtn[i].addEventListener("click" , () =>{

        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function () {
            if(this.readyState == 4 && this.status == 200) {

                document.querySelector(".modal-body p").innerHTML = this.responseText;
            }
        }
        xml.open("GET" , "/admin/GetTicketText/" + showTicketTextBtn[i].getAttribute("data-id"));
        xml.send();

    });
}