
let like_btns = document.querySelectorAll(".like_btns.like")
let unlike_btns = document.querySelectorAll(".like_btns.unlike")

for(let i =0;i<like_btns.length;i++) {

    like_btns[i].addEventListener("click" , () => {

        like_btns[i].classList.add("loading")
        unlike_btns[i].classList.remove("loading");

        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function () {
            if(this.readyState == 4 && this.status == 200) {

                like_btns[i].classList.remove("loading")

                let result = this.responseText.split("|");

          
                if(result.length == 1) {

                    Swal.fire({

                        icon: 'error',
                        title: result[0],
                        toast: true,
                        timer: 5000,
                        timerProgressBar: true,
                        customClass: {
                            container: 'swal2-toast',
                        }
                    })
                }
                else {

                    let fillLiked = "<svg class='liked_svg' xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' x='0' y='0' viewBox='0 0 24 24' style='enable-background:new 0 0 512 512' xml:space='preserve' class=''><g><path d='M22.773 7.721A4.994 4.994 0 0 0 19 6h-3.989l.336-2.041a3.037 3.037 0 0 0-5.721-1.837L8 5.417V21h10.3a5.024 5.024 0 0 0 4.951-4.3l.705-5a4.994 4.994 0 0 0-1.183-3.979ZM0 11v5a5.006 5.006 0 0 0 5 5h1V6H5a5.006 5.006 0 0 0-5 5Z' data-original='#000000' class=''></path></g></svg>" + "<span class='number'>" + result[0] + "</span>";

                    let fillUnLiked = "<svg class='liked_svg' xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' x='0' y='0' viewBox='0 0 24 24' style='enable-background:new 0 0 512 512' xml:space='preserve' class=''><g><path d='m23.951 12.3-.705-5A5.024 5.024 0 0 0 18.3 3H8v15.584l1.626 3.3a3.038 3.038 0 0 0 5.721-1.838L15.011 18H19a5 5 0 0 0 4.951-5.7ZM0 8v5a5.006 5.006 0 0 0 5 5h1V3H5a5.006 5.006 0 0 0-5 5Z' data-original='#000000' class=''></path></g></svg>" + "<span class='number'>" + result[1] + "</span>";

                    let emptyLike = "<svg class='unliked_svg' xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' x='0' y='0' viewBox='0 0 24 24'><g><path d='M22.773 7.721A4.994 4.994 0 0 0 19 6h-3.989l.336-2.041a3.037 3.037 0 0 0-5.721-1.837L7.712 6H5a5.006 5.006 0 0 0-5 5v5a5.006 5.006 0 0 0 5 5h13.3a5.024 5.024 0 0 0 4.951-4.3l.705-5a5 5 0 0 0-1.183-3.979ZM2 16v-5a3 3 0 0 1 3-3h2v11H5a3 3 0 0 1-3-3Zm19.971-4.581-.706 5A3.012 3.012 0 0 1 18.3 19H9V7.734a1 1 0 0 0 .23-.292l2.189-4.435a1.07 1.07 0 0 1 1.722-.207 1.024 1.024 0 0 1 .233.84l-.528 3.2A1 1 0 0 0 13.833 8H19a3 3 0 0 1 2.971 3.419Z'></path></g></svg>" + "<span class='number'>" + result[0] + "</span>";

                    let emptyUnLike = "<svg class='unliked_svg' xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' x='0' y='0' viewBox='0 0 24 24' style='enable-background:new 0 0 512 512' xml:space='preserve' class=''><g><path d='m23.951 12.3-.705-5A5.024 5.024 0 0 0 18.3 3H5a5.006 5.006 0 0 0-5 5v5a5.006 5.006 0 0 0 5 5h2.712l1.914 3.878a3.037 3.037 0 0 0 5.721-1.837L15.011 18H19a5 5 0 0 0 4.951-5.7ZM5 5h2v11H5a3 3 0 0 1-3-3V8a3 3 0 0 1 3-3Zm16.264 9.968A3 3 0 0 1 19 16h-5.167a1 1 0 0 0-.987 1.162l.528 3.2a1.024 1.024 0 0 1-.233.84 1.07 1.07 0 0 1-1.722-.212L9.23 16.558a1 1 0 0 0-.23-.292V5h9.3a3.012 3.012 0 0 1 2.97 2.581l.706 5a3 3 0 0 1-.712 2.387Z' data-original='#000000' class=''></path></g></svg>" + "<span class='number'>" + result[1] + "</span>";

                    if(result[2] == 0) {

                        like_btns[i].querySelector(".texts").innerHTML = emptyLike;
                    }
                    else if(result[2] == 1) {

                        like_btns[i].querySelector(".texts").innerHTML = fillLiked;
                    }

                    if(result[3] == 0) {

                        unlike_btns[i].querySelector(".texts").innerHTML = emptyUnLike;
                    }
                    else if(result[3] == 1) {

                        unlike_btns[i].querySelector(".texts").innerHTML = fillUnLiked;
                    }


                    Swal.fire({

                        icon: 'success',
                        title: result[4],
                        toast: true,
                        timer: 5000,
                        timerProgressBar: true,
                        customClass: {
                            container: 'swal2-toast',
                        }
                    })
                }
            }
        }
        xml.open("GET" , "/Job/comments/like/" + like_btns[i].getAttribute("data-comment") + '/' + like_btns[i].getAttribute("data-type"));
        xml.send();
    })

    unlike_btns[i].addEventListener("click" , () => {

        unlike_btns[i].classList.add("loading")
        like_btns[i].classList.remove("loading")

        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function () {
            if(this.readyState == 4 && this.status == 200) {

                unlike_btns[i].classList.remove("loading")

                let result = this.responseText.split("|");

                if(result.length == 1) {

                    Swal.fire({

                        icon: 'error',
                        title: result[0],
                        toast: true,
                        timer: 5000,
                        timerProgressBar: true,
                        customClass: {
                            container: 'swal2-toast',
                        }
                    })
                }
                else {

                    let fillLiked = "<svg class='liked_svg' xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' x='0' y='0' viewBox='0 0 24 24' style='enable-background:new 0 0 512 512' xml:space='preserve' class=''><g><path d='M22.773 7.721A4.994 4.994 0 0 0 19 6h-3.989l.336-2.041a3.037 3.037 0 0 0-5.721-1.837L8 5.417V21h10.3a5.024 5.024 0 0 0 4.951-4.3l.705-5a4.994 4.994 0 0 0-1.183-3.979ZM0 11v5a5.006 5.006 0 0 0 5 5h1V6H5a5.006 5.006 0 0 0-5 5Z' data-original='#000000' class=''></path></g></svg>" + "<span class='number'>" + result[0] + "</span>";

                    let fillUnLiked = "<svg class='liked_svg' xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' x='0' y='0' viewBox='0 0 24 24' style='enable-background:new 0 0 512 512' xml:space='preserve' class=''><g><path d='m23.951 12.3-.705-5A5.024 5.024 0 0 0 18.3 3H8v15.584l1.626 3.3a3.038 3.038 0 0 0 5.721-1.838L15.011 18H19a5 5 0 0 0 4.951-5.7ZM0 8v5a5.006 5.006 0 0 0 5 5h1V3H5a5.006 5.006 0 0 0-5 5Z' data-original='#000000' class=''></path></g></svg>" + "<span class='number'>" + result[1] + "</span>";

                    let emptyLike = "<svg class='unliked_svg' xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' x='0' y='0' viewBox='0 0 24 24'><g><path d='M22.773 7.721A4.994 4.994 0 0 0 19 6h-3.989l.336-2.041a3.037 3.037 0 0 0-5.721-1.837L7.712 6H5a5.006 5.006 0 0 0-5 5v5a5.006 5.006 0 0 0 5 5h13.3a5.024 5.024 0 0 0 4.951-4.3l.705-5a5 5 0 0 0-1.183-3.979ZM2 16v-5a3 3 0 0 1 3-3h2v11H5a3 3 0 0 1-3-3Zm19.971-4.581-.706 5A3.012 3.012 0 0 1 18.3 19H9V7.734a1 1 0 0 0 .23-.292l2.189-4.435a1.07 1.07 0 0 1 1.722-.207 1.024 1.024 0 0 1 .233.84l-.528 3.2A1 1 0 0 0 13.833 8H19a3 3 0 0 1 2.971 3.419Z'></path></g></svg>" + "<span class='number'>" + result[0] + "</span>";

                    let emptyUnLike = "<svg class='unliked_svg' xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' x='0' y='0' viewBox='0 0 24 24' style='enable-background:new 0 0 512 512' xml:space='preserve' class=''><g><path d='m23.951 12.3-.705-5A5.024 5.024 0 0 0 18.3 3H5a5.006 5.006 0 0 0-5 5v5a5.006 5.006 0 0 0 5 5h2.712l1.914 3.878a3.037 3.037 0 0 0 5.721-1.837L15.011 18H19a5 5 0 0 0 4.951-5.7ZM5 5h2v11H5a3 3 0 0 1-3-3V8a3 3 0 0 1 3-3Zm16.264 9.968A3 3 0 0 1 19 16h-5.167a1 1 0 0 0-.987 1.162l.528 3.2a1.024 1.024 0 0 1-.233.84 1.07 1.07 0 0 1-1.722-.212L9.23 16.558a1 1 0 0 0-.23-.292V5h9.3a3.012 3.012 0 0 1 2.97 2.581l.706 5a3 3 0 0 1-.712 2.387Z' data-original='#000000' class=''></path></g></svg>" + "<span class='number'>" + result[1] + "</span>";

                    if(result[2] == 0) {

                        like_btns[i].querySelector(".texts").innerHTML = emptyLike;
                    }
                    else if(result[2] == 1) {

                        like_btns[i].querySelector(".texts").innerHTML = fillLiked;
                    }

                    if(result[3] == 0) {

                        unlike_btns[i].querySelector(".texts").innerHTML = emptyUnLike;
                    }
                    else if(result[3] == 1) {

                        unlike_btns[i].querySelector(".texts").innerHTML = fillUnLiked;
                    }


                    Swal.fire({

                        icon: 'success',
                        title: result[4],
                        toast: true,
                        timer: 5000,
                        timerProgressBar: true,
                        customClass: {
                            container: 'swal2-toast',
                        }
                    })
                }
            }
        }
        xml.open("GET" , "/Job/comments/unlike/" + unlike_btns[i].getAttribute("data-comment") + '/' + unlike_btns[i].getAttribute("data-type"));
        xml.send();
    })
}