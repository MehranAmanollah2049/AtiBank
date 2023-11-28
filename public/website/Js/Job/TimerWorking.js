
let TimeWorking = document.querySelectorAll(".days_box");



function TimeWorkingCheck() {

    let Date = new persianDate();
    let DateName = Date.toLocale("en").format("dddd");

    if(DateName == "Saturday") {

        removeTimerCheckActive();
        TimeWorking[0].classList.add("active");
        
    }
     if(DateName == "Sunday") {

        removeTimerCheckActive();
        TimeWorking[1].classList.add("active");
        
    }
     if(DateName == "Monday") {

        removeTimerCheckActive();
        TimeWorking[2].classList.add("active");
        
    }
     if(DateName == "Tuesday") {

        removeTimerCheckActive();
        TimeWorking[3].classList.add("active");
        
    }
     if(DateName == "Wednesday") {

        removeTimerCheckActive();
        TimeWorking[4].classList.add("active");
        
    }
     if(DateName == "Thursday") {

        removeTimerCheckActive();
        TimeWorking[5].classList.add("active");
        
    }
     if(DateName == "Friday") {

        removeTimerCheckActive();
        TimeWorking[6].classList.add("active");
        
    }

}

function removeTimerCheckActive() {

    TimeWorking.forEach(timework =>{

        timework.classList.remove("active")

    });
}

TimeWorkingCheck()







