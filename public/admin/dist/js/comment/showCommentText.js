
let showCommentTextBtn = document.querySelectorAll(".showCommentTextBtn");


for(let i =0;i<showCommentTextBtn.length;i++) {

    showCommentTextBtn[i].addEventListener("click" , () =>{

        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function () {
            if(this.readyState == 4 && this.status == 200) {
                
                document.querySelector(".modal-body p").innerHTML = this.responseText;
            }
        }
        xml.open("GET" , "/admin/GetCommentText/" + showCommentTextBtn[i].getAttribute("data-id"));
        xml.send();

    });
}