
let searchAll = document.querySelector(".searchAll");
let search_btn = document.querySelector("#searchBtn");
let overlay_search = document.querySelector(".overlay_search")


search_btn.addEventListener("click", () => {

    searchAll.classList.add("active")
})

overlay_search.addEventListener("click", () => {

    searchAll.classList.remove("active")
})


let search_form = document.querySelector(".search_form");
let search_formInt = document.querySelector(".search_form input");
let searchResultCon = document.querySelector(".searchResultCon")

search_formInt.addEventListener("keyup", searchContent)
window.addEventListener("load", searchContent)


function searchContent(e) {

    if (search_formInt.value != '') {

        searchResultCon.classList.remove("disable")
        search_form.classList.add("loading");

        let xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                let result = this.responseText;

                if(!searchResultCon.classList.contains("disable")) {

                    if (result != 'null') {

                        searchResultCon.innerHTML = result;
                        searchResultCon.classList.add("active");
                    }
                    else {
    
                        searchResultCon.classList.remove("active")
                        searchResultCon.innerHTML = '';
                    }
    
                }
                

                search_form.classList.remove("loading");

            }
        }
        xmlHttp.open("Get", "/searchJob/" + search_formInt.value);
        xmlHttp.send();


    }
    else {

        search_form.classList.remove("loading");
        searchResultCon.classList.remove("active")
        searchResultCon.classList.add("disable")
        searchResultCon.innerHTML = '';


    }

    // if (e.key != 'Backspace') {

    //     if (search_formInt.value != '') {

    //         search_form.classList.add("loading");

    //         let xmlHttp = new XMLHttpRequest();
    //         xmlHttp.onreadystatechange = function () {
    //             if (this.readyState == 4 && this.status == 200) {
    //                 let result = this.responseText;

    //                 if (result != 'null') {

    //                     searchResultCon.innerHTML = result;
    //                     searchResultCon.classList.add("active");
    //                 }
    //                 else {

    //                     searchResultCon.classList.remove("active")
    //                     searchResultCon.innerHTML = '';
    //                 }


    //                 search_form.classList.remove("loading");

    //             }
    //         }
    //         xmlHttp.open("Get", "/searchJob/" + search_formInt.value);
    //         xmlHttp.send();


    //     }
    //     else {

    //         search_form.classList.remove("loading");
    //         searchResultCon.classList.remove("active")
    //         searchResultCon.innerHTML = '';

    //     }
    // }
    // else {

    //     if (search_formInt.value.length >= 1) {

    //         search_form.classList.add("loading");

    //         let xmlHttp = new XMLHttpRequest();
    //         xmlHttp.onreadystatechange = function () {
    //             if (this.readyState == 4 && this.status == 200) {
    //                 let result = this.responseText;

    //                 if (result != 'null') {

    //                     searchResultCon.innerHTML = result;
    //                     searchResultCon.classList.add("active");
    //                 }
    //                 else {

    //                     searchResultCon.classList.remove("active")
    //                     searchResultCon.innerHTML = '';
    //                 }


    //                 search_form.classList.remove("loading");

    //             }
    //         }
    //         xmlHttp.open("Get", "/searchJob/" + search_formInt.value);
    //         xmlHttp.send();
    //     }
    //     else {

    //         search_form.classList.remove("loading");
    //         searchResultCon.classList.remove("active")
    //         searchResultCon.innerHTML = '';
    //     }


    // }


}