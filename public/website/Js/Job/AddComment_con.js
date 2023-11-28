
let CommentAdd_con = document.querySelector(".CommentAdd_con.Cmt")
let commentShadow = document.querySelector(".CommentAdd_con.Cmt .commentShadow")
let close_comment_con = document.querySelector(".CommentAdd_con.Cmt .close_comment_con")
let addCommentBtn = document.querySelector(".addCommentBtn")

addCommentBtn.addEventListener("click" , () => {

    CommentAdd_con.classList.add("active")
})

commentShadow.addEventListener("click" , () => {

    CommentAdd_con.classList.remove("active")
})

close_comment_con.addEventListener("click" , () => {

    CommentAdd_con.classList.remove("active")
})