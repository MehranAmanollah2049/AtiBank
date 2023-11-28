let selectCountry = document.querySelector(".selectCountry");
let selectState = document.querySelector(".selectState");
let selectMainCategory = document.querySelector(".selectMainCategory");

$(".selectCountry").on("change", function () {
    let val = selectCountry.value == "" ? "" : selectCountry.value;

    if (val != "") {
        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.querySelector(".selectState").innerHTML =this.responseText.split("|")[0];
                document.querySelector(".selectCity").innerHTML =this.responseText.split("|")[1];
            }
        };
        xml.open("GET", "/admin/getStates/" + selectCountry.value);
        xml.send();
    } else {
        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.querySelector(".selectCity").innerHTML =this.responseText;
                document.querySelector(".selectState").innerHTML =this.responseText;
            }
        };
        xml.open("GET", "/getEmptySelect");
        xml.send();
    }
});

$(".selectState").on("change", function () {
    let val = selectState.value == "" ? "" : selectState.value;

    if (val != "") {
        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.querySelector(".selectCity").innerHTML =this.responseText;
            }
        };
        xml.open("GET", "/admin/getCitys/" + val);
        xml.send();
    } else {
        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.querySelector(".selectCity").innerHTML =this.responseText;
            }
        };
        xml.open("GET", "/getEmptySelect");
        xml.send();
    }
});

$(".selectMainCategory").on("change", function () {
    let val = selectMainCategory.value == "" ? "" : selectMainCategory.value;

    if(val != "") {

        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.querySelector(".selectSubCategory").innerHTML =this.responseText;
            }
        };
        xml.open("GET", "/admin/getSubcategorys/" + val);
        xml.send();
    }
    else {

        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.querySelector(".selectSubCategory").innerHTML =this.responseText;
            }
        };
        xml.open("GET", "/getEmptySelect");
        xml.send();
    }
    
});
