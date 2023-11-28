
let CommentAdd_con3 = document.querySelector(".CommentAdd_con.Ticket")
let commentShadow3 = document.querySelector(".CommentAdd_con.Ticket .commentShadow")
let close_comment_con3 = document.querySelector(".CommentAdd_con.Ticket .close_comment_con")
let addCommentBtn3 = document.querySelector(".sendTicketBtn")

addCommentBtn3.addEventListener("click" , () => {

    CommentAdd_con3.classList.add("active")
})

commentShadow3.addEventListener("click" , () => {

    CommentAdd_con3.classList.remove("active")
})

close_comment_con3.addEventListener("click" , () => {

    CommentAdd_con3.classList.remove("active")
})