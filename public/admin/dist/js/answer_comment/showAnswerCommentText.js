
let showAnswerCommentTextBtn = document.querySelectorAll(".showAnswerCommentTextBtn");


for(let i =0;i<showAnswerCommentTextBtn.length;i++) {

    showAnswerCommentTextBtn[i].addEventListener("click" , () =>{

        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function () {
            if(this.readyState == 4 && this.status == 200) {

                document.querySelector(".modal-body p").innerHTML = this.responseText;
            }
        }
        xml.open("GET" , "/admin/GetAnswerCommentText/" + showAnswerCommentTextBtn[i].getAttribute("data-id"));
        xml.send();

    });
}