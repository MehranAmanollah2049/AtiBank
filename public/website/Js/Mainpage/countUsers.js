
let users_all_num = document.querySelector(".users_all_num")


let userNum = users_all_num.getAttribute("data-users");

users_all_num.innerHTML = Intl.NumberFormat('en', { notation: 'compact' }).format(userNum);