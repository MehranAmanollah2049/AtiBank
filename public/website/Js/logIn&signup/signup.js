
let drps_overlay = document.querySelector(".drps_overlay");
let drp_btn = document.querySelectorAll(".drp_btn");
let drps = document.querySelectorAll(".drps")
let drp_btn_title = document.querySelectorAll(".drp_btn span")

let loadingConn = document.querySelector(".loadingCon")

// active drop downs
for (let i = 0; i < drp_btn.length; i++) {

    drp_btn[i].addEventListener("click", () => {

        if (!drps[i].classList.contains("active")) {

            removeAllDrps()
            drps[i].classList.toggle("active")
            drps_overlay.classList.toggle("active")
        }
        else {

            removeAllDrps()
        }

    })
}

drps_overlay.addEventListener("click", removeAllDrps)

function removeAllDrps() {

    drps.forEach(drp => {

        drp.classList.remove("active")
    })
    drps_overlay.classList.remove("active")
}

// get states
function GetStates(id, e) {

    loadingConn.classList.add("active")

    let xml = new XMLHttpRequest();
    xml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            loadingConn.classList.remove("active")
            document.querySelector(".drps.state").innerHTML = this.responseText.split("|")[0];
            document.querySelector(".drps.city").innerHTML = this.responseText.split("|")[1];
            document.querySelector(".drp_btn_span_city").innerHTML = this.responseText.split("|")[2];
            document.querySelector(".drp_btn_span_state").innerHTML = this.responseText.split("|")[2];
            removeAllDrps()
            drp_btn_title[0].innerHTML = e.target.innerHTML;
        }
    }
    xml.open("GET", "/GetStatesVal/" + id);
    xml.send();
}

// get cities
function getCitys(id, e) {

    loadingConn.classList.add("active")


    let xml = new XMLHttpRequest();
    xml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            loadingConn.classList.remove("active")
            document.querySelector(".drps.city").innerHTML = "";
            
            let result = this.response.split("|");

            for(let i = 0;i<result.length - 1;i++) {

                document.querySelector(".drps.city").innerHTML += result[i];

            }

            removeAllDrps()
            drp_btn_title[1].innerHTML = e.target.innerHTML;
            drp_btn_title[2].innerHTML = result[result.length - 1];
            document.querySelector("#city_id").value = '';
        }
    }
    xml.open("GET", "/GetCitysVal/" + id);
    xml.send();
}

// pick City
function pickCity(id, e) {

    drp_btn_title[2].innerHTML = e.target.innerHTML;
    document.querySelector("#city_id").value = id;
    removeAllDrps()
}





