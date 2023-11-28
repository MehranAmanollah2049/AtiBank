let More_options_comment = document.querySelectorAll(".More_options_comment");
let more_options_comment_shadow = document.querySelectorAll(".more_options_comment_shadow");

for(let i =0;i<More_options_comment.length;i++) {

    More_options_comment[i].addEventListener("click" , () => {

        More_options_comment[i].classList.toggle("active")
        more_options_comment_shadow[i].classList.toggle("active")
    })
}


more_options_comment_shadow.forEach(more_options_comment_shadow => {

    more_options_comment_shadow.addEventListener("click" , () => {

        More_options_comment.forEach(More_options_comment => {
    
            More_options_comment.classList.remove("active")
        })
        more_options_comment_shadow.classList.remove("active")
    })

})



let CommentAdd_con2 = document.querySelector(".CommentAdd_con.Answer")
let commentShadow2 = document.querySelector(".CommentAdd_con.Answer .commentShadow")
let close_comment_con2 = document.querySelector(".CommentAdd_con.Answer .close_comment_con")
let addCommentBtn2 = document.querySelectorAll(".answer_btn")

for(let i =0;i<addCommentBtn2.length;i++) {

    addCommentBtn2[i].addEventListener("click" , () => {

        CommentAdd_con2.classList.add("active")

        document.querySelector("#receiver").value = addCommentBtn2[i].getAttribute("data-receiver");
        document.querySelector("#comment_id").value = addCommentBtn2[i].getAttribute("data-comment_id");
        document.querySelector("#type_receiver").value = addCommentBtn2[i].getAttribute("data-type_receiver");
    })
}



commentShadow2.addEventListener("click" , () => {

    CommentAdd_con2.classList.remove("active")
})

close_comment_con2.addEventListener("click" , () => {

    CommentAdd_con2.classList.remove("active")
})