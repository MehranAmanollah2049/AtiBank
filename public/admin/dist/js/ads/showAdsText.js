
let showAdsTextBtn = document.querySelectorAll(".showAdsTextBtn");


for(let i =0;i<showAdsTextBtn.length;i++) {

    showAdsTextBtn[i].addEventListener("click" , () =>{


        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function () {
            if(this.readyState == 4 && this.status == 200) {
           
                document.querySelector(".modal-body").innerHTML = this.responseText;
            }
        }
        xml.open("GET" , "/admin/GetAdsText/" + showAdsTextBtn[i].getAttribute("data-id"));
        xml.send();

    });
}