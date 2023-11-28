
let profile = document.querySelector("#profile");
let profileUserCon = document.querySelector(".profileUserCon")
let profileUser = document.querySelector(".profileUser")
let deleteShadow = document.querySelector(".deleteShadow")

profile.addEventListener("change", (e) => {

    let reader = new FileReader();

    reader.addEventListener("load", () => {

        let result = reader.result;

        profileUserCon.classList.add("uploaded");
        profileUser.style.backgroundImage = `url(${result})`;
        document.querySelector("#profile_status").value = '';
    })

    reader.readAsDataURL(profile.files[0])
})


deleteShadow.addEventListener("click", () => {

    profileUserCon.classList.remove("uploaded");
    profileUser.style.backgroundImage = `url(/Tools/Images/Website_images/user.svg)`;
    document.querySelector("#profile_status").value = 'deleted';
    profile.value = '';
})
