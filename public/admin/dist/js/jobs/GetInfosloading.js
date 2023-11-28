let selectCountry2 = document.querySelector(".selectCountry")
let selectState2 = document.querySelector(".selectState")
let selectMainCategory2 = document.querySelector(".selectMainCategory")


window.addEventListener("load" , () => {

    let xml = new XMLHttpRequest();
    xml.onreadystatechange = function () {
        if(this.readyState == 4 && this.status == 200) {

            document.querySelector(".selectState").innerHTML = this.responseText;
        }
    }
    xml.open("GET", "/admin/getStates/" + selectCountry2.value);
    xml.send();


    let xml2 = new XMLHttpRequest();
    xml2.onreadystatechange = function () {
        if(this.readyState == 4 && this.status == 200) {

            document.querySelector(".selectCity").innerHTML = this.responseText;
        }
    }
    xml2.open("GET", "/admin/getCitys/" + selectState2.value);
    xml2.send();


    let xml3 = new XMLHttpRequest();
    xml3.onreadystatechange = function () {
        if(this.readyState == 4 && this.status == 200) {

            document.querySelector(".selectSubCategory").innerHTML = this.responseText;
        }
    }
    xml3.open("GET", "/admin/getSubcategorys/" + selectMainCategory2.value);
    xml3.send();
})