
let filter_box_con = document.querySelectorAll(".filter_box_con");
let filter_box_top = document.querySelectorAll(".filter_box_top")
let filter_box_bottom = document.querySelectorAll(".filter_box_bottom")
let filter_content_sec = document.querySelectorAll(".filter_content_sec")

for (let i = 0; i < filter_box_con.length; i++) {

    filter_box_top[i].addEventListener("click", () => {

        if (!filter_box_con[i].classList.contains("active")) {

            removeAllDrps()
            activeFilter(filter_box_con[i], filter_box_bottom[i], filter_content_sec[i])
        }
        else {

            removeAllDrps()
        }

    });
}


function removeAllDrps() {

    filter_box_con.forEach(filter_box_con => {

        filter_box_con.classList.remove("active")
    })

    filter_box_bottom.forEach(filter_box_bottom => {

        filter_box_bottom.style.height = '0px';
    })
}

function addHeight(main, sub) {

    let Height = sub.clientHeight + 32;

    main.style.height = Height + 'px'
}

function activeFilter(main1, main, sub) {

    main1.classList.add("active")
    addHeight(main, sub)
}


// ajax

function getState(e, id) {

    let parent = e.target.parentElement;

    let allCountryCheckBoxs = document.querySelectorAll(".filter_content_sec.country input");

    let int = e.target.querySelector("input")

    if (int.checked == false) {

        removeAllItns(allCountryCheckBoxs)
        int.checked = true;
    }
    else {

        removeAllItns(allCountryCheckBoxs)
    }

    if (int.checked == true) {

        e.target.classList.add("loading")

        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                e.target.classList.remove("loading")

                removeAllDrps()
                
                if (parent.classList.contains("XS")) {
                    
                    getEmpty('state', document.querySelectorAll(".filter_content_sec.city")[1])              
                    document.querySelectorAll(".filter_content_sec.state")[1].innerHTML = this.responseText;
                    activeFilter(filter_box_con[7], filter_box_bottom[7], filter_content_sec[7])
                }
                else {

                    getEmpty('state', document.querySelectorAll(".filter_content_sec.city")[0])   
                    document.querySelectorAll(".filter_content_sec.state")[0].innerHTML = this.responseText;
                    activeFilter(filter_box_con[1], filter_box_bottom[1], filter_content_sec[1])
                }


            }
        }
        xml.open("GET", "/Filter/getStates/" + id);
        xml.send();
    }
    else {

        if(parent.classList.contains("XS")) {

            getEmpty('country', document.querySelectorAll(".filter_content_sec.state")[1])
            getEmpty('state', document.querySelectorAll(".filter_content_sec.city")[1])
        }
        else {

            getEmpty('country', document.querySelectorAll(".filter_content_sec.state")[0])
            getEmpty('state', document.querySelectorAll(".filter_content_sec.city")[0])

        }
    }
}



function getCity(e, id) {

    let parent = e.target.parentElement;

    let allStateCheckBoxs = document.querySelectorAll(".filter_content_sec.state input");

    let int = e.target.querySelector("input")

    if (int.checked == false) {

        removeAllItns(allStateCheckBoxs)
        int.checked = true;
    }
    else {

        removeAllItns(allStateCheckBoxs)
    }

    if (int.checked == true) {

        e.target.classList.add("loading")

        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                e.target.classList.remove("loading")

                removeAllDrps()

                if (parent.classList.contains("XS")) {

                    document.querySelectorAll(".filter_content_sec.city")[1].innerHTML = this.responseText;
                    activeFilter(filter_box_con[8], filter_box_bottom[8], filter_content_sec[8])

                }
                else {

                    document.querySelectorAll(".filter_content_sec.city")[0].innerHTML = this.responseText;
                    activeFilter(filter_box_con[2], filter_box_bottom[2], filter_content_sec[2])

                }


            }
        }
        xml.open("GET", "/Filter/getCitys/" + id);
        xml.send();
    }
    else {

        if(parent.classList.contains("XS")) {

            getEmpty('state', document.querySelectorAll(".filter_content_sec.city")[1])

        }
        else {

            getEmpty('state', document.querySelectorAll(".filter_content_sec.city")[0])

        }

    }
}

function selectCity(e) {


    let allCityCheckBoxs = document.querySelectorAll(".filter_content_sec.city input");

    let int = e.target.querySelector("input")

    if (int.checked == false) {

        removeAllItns(allCityCheckBoxs)
        int.checked = true;
    }
    else {

        removeAllItns(allCityCheckBoxs)
    }

}

function getSubs(e, id) {

    let parent = e.target.parentElement;

    let allCountryCheckBoxs = document.querySelectorAll(".filter_content_sec.mainCategory input");

    let int = e.target.querySelector("input")

    if (int.checked == false) {

        removeAllItns(allCountryCheckBoxs)
        int.checked = true;
    }
    else {

        removeAllItns(allCountryCheckBoxs)
    }

    if (int.checked == true) {


        e.target.classList.add("loading")

        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                e.target.classList.remove("loading")

                removeAllDrps()

                if (parent.classList.contains("XS")) {

                    document.querySelectorAll(".filter_content_sec.subs")[1].innerHTML = this.responseText;
                    activeFilter(filter_box_con[10], filter_box_bottom[10], filter_content_sec[10])

                }
                else {

                    document.querySelectorAll(".filter_content_sec.subs")[0].innerHTML = this.responseText;
                    activeFilter(filter_box_con[4], filter_box_bottom[4], filter_content_sec[4])

                }


            }
        }
        xml.open("GET", "/Filter/getSubs/" + id);
        xml.send();
    }
    else {

        if(parent.classList.contains("XS")) {

            getEmpty('sub', document.querySelectorAll(".filter_content_sec.subs")[1])

        }
        else {
            
            getEmpty('sub', document.querySelectorAll(".filter_content_sec.subs")[0])

        }
    }
}

function selectsubcategory(e) {

    let allCityCheckBoxs = document.querySelectorAll(".filter_content_sec.subs input");

    let int = e.target.querySelector("input")

    if (int.checked == false) {

        removeAllItns(allCityCheckBoxs)
        int.checked = true;
    }
    else {

        removeAllItns(allCityCheckBoxs)
    }

}

function selectOrder(e) {

    let allCityCheckBoxs = document.querySelectorAll(".filter_content_sec.order input");

    let int = e.target.querySelector("input")

    if (int.checked == false) {

        removeAllItns(allCityCheckBoxs)
        int.checked = true;
    }
    else {

        removeAllItns(allCityCheckBoxs)
    }
}

function removeAllItns(ints) {

    ints.forEach(int => {

        int.checked = false;
    })
}

function getEmpty(type, link) {

    let xml = new XMLHttpRequest();
    xml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            link.innerHTML = this.responseText;

        }
    }
    xml.open("GET", "/Filter/getEmpty/" + type);
    xml.send();
}


window.addEventListener("load", () => {

    let allCountryCheckBoxs = document.querySelectorAll(".filter_content_sec.country input");

    if (!window.location.href.includes("country")) {

        allCountryCheckBoxs.forEach(allCountryCheckBoxs => {

            allCountryCheckBoxs.checked = false;
        })
    }

    let allCategoryCheckBoxs = document.querySelectorAll(".filter_content_sec.mainCategory input");

    if (!window.location.href.includes("category")) {

        allCategoryCheckBoxs.forEach(allCategoryCheckBoxs => {

            allCategoryCheckBoxs.checked = false;
        })
    }


})



// show XS filter

let filter_all_formXS = document.querySelector(".filter_all_formXS")
let filter_shadow = document.querySelector(".filter_shadow")
let filterXS_btns = document.querySelectorAll(".filterXS_btns")
let drp_filterXS_box = document.querySelectorAll(".drp_filterXS_box")
let exit_filterXS = document.querySelectorAll(".exit_filterXS")

for (let i = 0; i < filterXS_btns.length; i++) {

    filterXS_btns[i].addEventListener("click", () => {

        removeAllXS_Filters();
        filter_all_formXS.classList.add("active")
        filter_all_formXS.classList.add("filter" + i)


    });

    exit_filterXS[i].addEventListener("click", () => {

        filter_all_formXS.classList.remove("active")
        removeAllXS_Filters()
    })
}


filter_shadow.addEventListener("click", () => {

    filter_all_formXS.classList.remove("active")
    removeAllXS_Filters()
})

function removeAllXS_Filters() {

    filter_all_formXS.classList.remove("filter0")
    filter_all_formXS.classList.remove("filter1")
}