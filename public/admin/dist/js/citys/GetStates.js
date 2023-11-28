
let selectCountry = document.querySelector(".selectCountry");

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