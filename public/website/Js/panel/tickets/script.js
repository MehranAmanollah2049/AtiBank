let OverlayAll = document.querySelector(".OverlayAll");
let loadingFotAjax = document.querySelector(".loadingCon");

// searchBox

let searchGaps = document.querySelector("#searchGaps");
let section_gaps_parts = document.querySelectorAll(".section_gaps")

searchGaps.addEventListener("input", () => {

    document.querySelector(".searchBox").classList.add("loading");

    if (searchGaps.value != '') {

        if (section_gaps_parts[0].classList.contains("active")) {

            let xml = new XMLHttpRequest();
            xml.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {

                    document.querySelector(".searchBox").classList.remove("loading");
                    let result = this.responseText;
                    section_gaps_parts[0].innerHTML = result;
                }
            }
            xml.open("GET", "getJobsList/" + searchGaps.value);
            xml.send();
        }
        else {


            let xml = new XMLHttpRequest();
            xml.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {

                    document.querySelector(".searchBox").classList.remove("loading");
                    let result = this.responseText;
                    section_gaps_parts[1].innerHTML = result;
                }
            }
            xml.open("GET", "getUserList/" + searchGaps.value);
            xml.send();
        }
    }
    else {

        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                document.querySelector(".searchBox").classList.remove("loading");
                let result = this.responseText;
                section_gaps_parts[1].innerHTML = result;
            }
        }
        xml.open("GET", "getUserList/all");
        xml.send();

        let xml2 = new XMLHttpRequest();
        xml2.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                document.querySelector(".searchBox").classList.remove("loading");
                let result = this.responseText;
                section_gaps_parts[0].innerHTML = result;
            }
        }
        xml2.open("GET", "getJobsList/all");
        xml2.send();
    }

});

// options
let options_msg = document.querySelectorAll(".options_msg");
let underline_border = document.querySelector(".underline_border");
let section_gaps = document.querySelectorAll(".section_gaps");

for (let i = 0; i < options_msg.length; i++) {
    options_msg[i].addEventListener("click", () => {
        removeAllOptions();
        options_msg[i].classList.add("active");
        underline_border.classList.add("active" + i);
        section_gaps[i].classList.add("active");
        searchGaps.value = ''
        getJobsList()
        getUserList()
    });
}

function removeAllOptions() {
    underline_border.classList.remove("active0");
    underline_border.classList.remove("active1");

    options_msg.forEach((options_msg) => {
        options_msg.classList.remove("active");
    });

    section_gaps.forEach((section_gaps) => {
        section_gaps.classList.remove("active");
    });
}

// emojis

let emojiBtn = document.querySelector(".emoji");
let emojiCon = document.querySelector(".emojiCon");

emojiBtn.addEventListener("click", () => {
    emojiCon.classList.toggle("active");
    OverlayAll.classList.toggle("active");
});

// const pickerOptions = { native };
const picker = new EmojiMart.Picker({
    onEmojiSelect: (e) => {
        document.querySelector("#text_int").value += e.native;
    },
});

emojiCon.appendChild(picker);

OverlayAll.addEventListener("click", () => {
    emojiCon.classList.remove("active");
    OverlayAll.classList.remove("active");
    removeAllSelectedDel();
});

// upload image

let file = document.querySelector("#file");
let uploadedImageCon = document.querySelector(".uploadedImageCon");
let deleteBtn = document.querySelector(".deleteBtn");

file.addEventListener("change", () => {
    let reader = new FileReader();

    reader.addEventListener("load", () => {
        let result = reader.result;
        uploadedImageCon.classList.add("active");
        uploadedImageCon.querySelector(
            ".imageUploaded"
        ).style.backgroundImage = `url(${result})`;
        fileStatus.value = '';
    });

    reader.readAsDataURL(file.files[0]);
});

deleteBtn.addEventListener("click", () => {
    file.value = "";
    uploadedImageCon.classList.remove("active");
    uploadedImageCon.querySelector(
        ".imageUploaded"
    ).style.backgroundImage = `url()`;

    if (formMassanger.getAttribute("data-type") == 'edit') {

        fileStatus.value = 'deleted';
    }
    else {

        fileStatus.value = '';
    }

});

// get jobs that i sent message for them

function getJobsList() {

    if (searchGaps.value != '') {

        if (section_gaps[0].classList.contains("active")) {

            let xml = new XMLHttpRequest();
            xml.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {

                    let result = this.responseText;
                    section_gaps[0].innerHTML = result;
                }
            };
            xml.open("GET", "getJobsList/" + searchGaps.value);
            xml.send();
        }
        else {

            let xml = new XMLHttpRequest();
            xml.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    let result = this.responseText;
                    section_gaps[0].innerHTML = result;
                }
            };
            xml.open("GET", "getJobsList/all");
            xml.send();
        }
    }
    else {

        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                let result = this.responseText;
                section_gaps[0].innerHTML = result;
            }
        };
        xml.open("GET", "getJobsList/all");
        xml.send();
    }
}


// get users that sent message for my jobs

function getUserList() {

    if (searchGaps.value != '') {

        if (section_gaps[1].classList.contains("active")) {

            let xml = new XMLHttpRequest();
            xml.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    let result = this.responseText;
                    section_gaps[1].innerHTML = result;
                }
            };
            xml.open("GET", "getUserList/" + searchGaps.value);
            xml.send();
        }
        else {

            let xml = new XMLHttpRequest();
            xml.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    let result = this.responseText;
                    section_gaps[1].innerHTML = result;
                }
            };
            xml.open("GET", "getUserList/all");
            xml.send();
        }
    }
    else {

        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                let result = this.responseText;
                section_gaps[1].innerHTML = result;
            }
        };
        xml.open("GET", "getUserList/all");
        xml.send();
    }
}



// set sender and receiver sessions

function setDatas(sender_id, sender_type, receiver_id, receiver_type) {
    loadingFotAjax.classList.add("active");

    let xml = new XMLHttpRequest();
    xml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            loadingFotAjax.classList.remove("active");
            getGetterInfo()

            document.querySelector(".Right_massanger_section").classList.add("active")
            formMassanger.setAttribute("data-type", "insert");
            formMassanger.setAttribute("action", "/panel/massanger/addMsg");
            formMassanger.classList.remove("editMode")
            formMassanger.removeAttribute("data-id");

            freshForm()

            // refresh datas
            getAllMsgs();
            getJobsList();
            getUserList();
        }
    };
    xml.open(
        "GET",
        "setDatas/" +
        sender_id +
        "/" +
        sender_type +
        "/" +
        receiver_id +
        "/" +
        receiver_type
    );
    xml.send();
}

document.querySelector(".closeChatBtn").addEventListener("click", () => {

    document.querySelector(".Right_massanger_section").classList.remove("active")
})

// delete messages

let Massanger_Con = document.querySelector(".Massanger_Con");
let MessageAllMe = document.querySelectorAll(".MessageAll.Me");
let setTimer;

function checkForDel(e) {
    if (!Massanger_Con.classList.contains("deleteOn")) {
        setTimer = setTimeout(() => {
            removeAllSelectedDel();
            e.target.classList.add("showMenu");
            OverlayAll.classList.add("active");
        }, 1500);
    }
}

function removeCheckDel() {
    clearTimeout(setTimer);
}

function removeAllSelectedDel() {
    MessageAllMe = document.querySelectorAll(".MessageAll.Me");
    MessageAllMe.forEach((MessageAllMe) => {
        MessageAllMe.classList.remove("showMenu");
    });
    OverlayAll.classList.remove("active")
}

function ShowMenuOptions(e) {
    e.target.classList.toggle("showMenu");
    OverlayAll.classList.add("active");
}

OverlayAll.addEventListener("wheel", () => {

    OverlayAll.classList.remove("active");
    removeAllSelectedDel()
})

// send message

let imageUploadSender2 = document.querySelector(".imageUploadSender");
let textsender2 = document.querySelector(".textsender");
let formMassanger = document.querySelector("#messaner_form");
let inputFilePlace = document.querySelector(".inputFilePlace")
let fileStatus = document.querySelector("#fileStatus")


$("#messaner_form").on("submit", function (e) {
    e.preventDefault();
    if (formMassanger.getAttribute("data-type") == "insert") {
        if (textsender2.value != "" || imageUploadSender2.value != "") {
            loadingFotAjax.classList.add("active");
            let DataTOsEND = new FormData(this);

            $.ajax({
                url: "/panel/massanger/addMsg",
                method: "post",
                data: DataTOsEND,
                dataType: "text",
                contentType: false,
                processData: false,
                success: function (php_script_response) {
                    let result = php_script_response.split("|");

                    if (result.length == 1 && result[0] == "true") {
                        freshForm();

                        // refresh datas
                        getAllMsgs();
                        getJobsList();
                        getUserList();

                    } else {
                        loadingFotAjax.classList.remove("active");
                        freshForm();
                        Swal.fire({
                            icon: "error",
                            title: result[1],
                            toast: true,
                            timer: 5000,
                            timerProgressBar: true,
                            customClass: {
                                container: "swal2-toast",
                            },
                        });
                    }
                },
            });
        }
    }
    else if (formMassanger.getAttribute("data-type") == "edit") {
        if (textsender2.value != "" || uploadedImageCon.classList.contains("active")) {

            loadingFotAjax.classList.add("active");
            let DataTOsEND = new FormData(this);

            $.ajax({
                url: "/panel/msg/" + formMassanger.getAttribute("data-id") + "/edit",
                method: "post",
                data: DataTOsEND,
                dataType: "text",
                contentType: false,
                processData: false,
                success: function (php_script_response) {
                    let result = php_script_response.split("|");
                    if (result.length == 1 && result[0] == "true") {
                        formMassanger.setAttribute("data-type", "insert");
                        formMassanger.setAttribute("action", "/panel/massanger/addMsg");
                        formMassanger.classList.remove("editMode")
                        formMassanger.removeAttribute("data-id");

                        freshForm()

                        // refresh datas
                        getAllMsgs();
                        getJobsList();
                        getUserList();


                    } else {
                        loadingFotAjax.classList.remove("active");
                        Swal.fire({
                            icon: "error",
                            title: result[1],
                            toast: true,
                            timer: 5000,
                            timerProgressBar: true,
                            customClass: {
                                container: "swal2-toast",
                            },
                        });
                    }
                },
            });
        }

    }

});

function freshForm() {
    textsender2.value = "";
    imageUploadSender2.value = "";
    uploadedImageCon.classList.remove("active");
    uploadedImageCon.querySelector(
        ".imageUploaded"
    ).style.backgroundImage = `url()`;
}

// get all messages

function getAllMsgs() {
    if (!loadingFotAjax.classList.contains("active")) {
        loadingFotAjax.classList.add("active");
    }

    let xml = new XMLHttpRequest();
    xml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            loadingFotAjax.classList.remove("active");
            let result = this.responseText;

            if (result == "EmptyAll") {
                document
                    .querySelector(".Right_massanger_section")
                    .classList.add("empty");
            } else {
                document
                    .querySelector(".Right_massanger_section")
                    .classList.remove("empty");
                document.querySelector(".ChatsAll").innerHTML = result;
                getGetterInfo();
                setTimeout(() => {
                    refreshScroll();
                }, 100);
            }
        }
    };
    xml.open("GET", "/panel/getAllMsgs");
    xml.send();
}



getAllMsgs();
getJobsList();
getUserList();

// refresh scroll
function refreshScroll() {
    let element = document.querySelector(".ChatsAll");
    $('.ChatsAll').animate({ scrollTop: (element.scrollHeight + 1000) }, "fast");
}

// edit msg
function editMsg(id) {
    loadingFotAjax.classList.add("active");

    let xml = new XMLHttpRequest();
    xml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            removeAllSelectedDel();
            loadingFotAjax.classList.remove("active");
            let result = this.responseText.split('|');

            formMassanger.setAttribute("data-type", "edit");
            formMassanger.setAttribute("data-id", result[2]);
            formMassanger.setAttribute("action", "/panel/msg/" + result[2] + '/edit');
            formMassanger.classList.add("editMode")


            freshForm();

            if (result[0] != 0 && result[1] == 0) {

                textsender2.value = result[0];

            } else if (result[0] == 0 && result[1] != 0) {

                uploadedImageCon.classList.add("active");
                uploadedImageCon.querySelector(".imageUploaded").style.backgroundImage = `url(/${result[1]})`;


            } else if (result[0] != 0 && result[1] != 0) {

                uploadedImageCon.classList.add("active");
                uploadedImageCon.querySelector(".imageUploaded").style.backgroundImage = `url(/${result[1]})`;
                textsender2.value = result[0];

            }
        }
    };
    xml.open("GET", "/panel/editMsg/" + id);
    xml.send();
}


let ToolsChatEditModeBtn = document.querySelector(".ToolsChat.editModeBtn")

ToolsChatEditModeBtn.addEventListener("click", () => {

    formMassanger.setAttribute("data-type", "insert");
    formMassanger.setAttribute("action", "/panel/massanger/addMsg");
    formMassanger.classList.remove("editMode")
    formMassanger.removeAttribute("data-id");

    freshForm()

})


function DeleteMsg(id) {

    loadingFotAjax.classList.add("active");

    let xml = new XMLHttpRequest();
    xml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            removeAllSelectedDel();
            loadingFotAjax.classList.remove("active");
            let result = this.responseText;
            if (result == 'true') {

                formMassanger.setAttribute("data-type", "insert");
                formMassanger.setAttribute("action", "/panel/massanger/addMsg");
                formMassanger.classList.remove("editMode")
                formMassanger.removeAttribute("data-id");

                freshForm()

                // refresh datas
                getAllMsgs();
                getJobsList();
                getUserList();
            }
        }
    };
    xml.open("GET", "/panel/deleteMsg/" + id);
    xml.send();
}

function getGetterInfo() {

    let xml = new XMLHttpRequest();
    xml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            let result = this.responseText.split('|');
            document.querySelector(".receiver_img").src = result[0];
            document.querySelector(".user_infos_tap .title").innerHTML =
                result[1];
            document.querySelector(".user_infos_tap .phone").innerHTML =
                result[2];
        }
    };
    xml.open("GET", "/panel/getGetterInfo");
    xml.send();
}

