var MONTHS = ["Janurary", "Feburary", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
var currentDateDisplayed = new Date();
var EVENTS = [];

function openCreateNewEvent() {
    var createEvent = document.getElementById("createNewEvent");
    if(createEvent.style.width == "500px"){
        createEvent.style.width = "0px";
        document.getElementById("calendarPage").style.width = "100%";
    
        var createNewEventButton = document.getElementById("createNewEventButton");
        createNewEventButton.style.right = "32px";
        createNewEventButton.style.minWidth = "170px";
        createNewEventButton.innerHTML = "Create Event";

        document.getElementById("createNewEventForm").className += "hide";
        
    } else {
        createEvent.style.width = "500px";
        document.getElementById("calendarPage").style.width = "calc(100% - 500px)";
    
        var createNewEventButton = document.getElementById("createNewEventButton");
        createNewEventButton.style.right = "calc(500px + 32px)";
        createNewEventButton.innerHTML = "X";
        createNewEventButton.style.minWidth = "25px";
        document.getElementById("createNewEventForm").classList.remove("hide");
    }
    
}

function createNewEventSave(){
    console.log("saved");

    //get all the data
    var title = $("#titleOfEvent").val();
    var startDate = $("#startDate").val();
    var endDate = $("#endDate").val();
    var startTime = $("#startTime").val();
    var endTime = $("#endTime").val();
    var allDay = $("#allDay").val();
    var eventLocation = $("#Location").val();
    var friends = $("#friends").val();
    var notes = $("#notesWritingArea").html();
    var color = String($("#eventColor").val()).substring(1);

    /*console.log(title);
    console.log(startDate);
    console.log(endDate);
    console.log(startTime);
    console.log(endTime);
    console.log(allDay);
    console.log(location);
    console.log(friends);
    console.log(notes);
    console.log(color);
    console.log("all done");*/

    $.ajax({
        method: "POST",
        url: "../PHP/calendar_AddEvent.php",
        data: { 
            title: title, 
            startDate: startDate,
            endDate: endDate,
            startTime: startTime,
            endTime: endTime,
            allDay: allDay,
            eventLocation: eventLocation,
            friends: friends,
            notes: notes,
            color: color
        }
      }).done(function( response ) {
        console.log(response);
        if(response == true){
            alert("New event added successfully");
            //document.getElementById("username").style.backgroundColor = "#fcc2c2";
        } else {
            alert("Event Creation Failed");
            //location.href = "../Pages/home.php";
        }
      });
}

/*
Sunday = 0
Monday = 1
Tuesday = 2
Wednesday = 3
Thursday = 4
Friday = 5
Saturday = 6
*/

function decreaseMonth() {
    console.log(`decrease month: ${currentDateDisplayed.getMonth()}`);
    var currentMonth = currentDateDisplayed.getMonth();
    var previousMonth = currentMonth - 1;

    if(previousMonth == -1){
        previousMonth = 11;
        currentDateDisplayed = new Date(currentDateDisplayed.getFullYear() - 1, previousMonth, 1);
    } else {
        currentDateDisplayed = new Date(currentDateDisplayed.getFullYear(), previousMonth, 1);
    }

    //update text
    $("#month").html(MONTHS[previousMonth]);

    //update the month
    removeCurrentMonthDisplayed();
    loadMonth(currentDateDisplayed);

    displayEventIcons();
}

function increaseMonth() {
    console.log(`increase month: ${currentDateDisplayed.getMonth()}`);
    var currentMonth = currentDateDisplayed.getMonth();
    var nextMonth = currentMonth + 1;

    if(nextMonth == 12){
        nextMonth = 0;
        currentDateDisplayed = new Date(currentDateDisplayed.getFullYear() + 1, nextMonth, 1);
    } else {
        currentDateDisplayed = new Date(currentDateDisplayed.getFullYear(), nextMonth, 1);
    }

    //update text
    $("#month").html(MONTHS[nextMonth]);

    //update the month
    removeCurrentMonthDisplayed();
    loadMonth(currentDateDisplayed);

    displayEventIcons();
}

function loadMonth(date){
    var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
    //previous month
    if(firstDay.getDay() != 0){
        var previousMonth = new Date(date.getFullYear(), date.getMonth(), 0);
        var numberOfDaysPrevious = previousMonth.getDate();

        for(let i = numberOfDaysPrevious - firstDay.getDay() + 1; i <= numberOfDaysPrevious; i++){
            console.log(i);
            var addDay = document.createElement("div");
            var innerHTML = `<div class="number">${i}</div>`;
            addDay.innerHTML = innerHTML;
            addDay.className = 'allDays inactive';
            document.getElementById("days").appendChild(addDay);
        }
    }

    //current month
    var currentMonthDays = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
    for(let i = 1; i <= currentMonthDays; i++){
        var addDay = document.createElement("div");
        var innerHTML = `<div class="number">${i}</div>`;
        addDay.innerHTML = innerHTML;
        addDay.className = 'allDays';
        addDay.id=`dayNumber${i}`;

        document.getElementById("days").appendChild(addDay);
    }

    //next month
    var totalDays = firstDay.getDay() + currentMonthDays;
    var numberOfRows = Math.ceil(totalDays/7);
    console.log(`Number of rows: ${numberOfRows}`);
    var numberOfDaysOnCalendar = numberOfRows*7;

    if(numberOfDaysOnCalendar != totalDays){
        for(let i = 1; i <= numberOfDaysOnCalendar - totalDays; i++){
            var addDay = document.createElement("div");
                var innerHTML = `<div class="number">${i}</div>`;
                addDay.innerHTML = innerHTML;
                addDay.className = 'allDays inactive';
                document.getElementById("days").appendChild(addDay);
        }
    }
}

function displayEventIcons(){
    //Get current month: currentDateDisplayed
    console.log(`Length of array: ${EVENTS.length}`);
    console.log(EVENTS);
    for(var i = 0; i < EVENTS.length; i++){
        console.log("Display Event Icon");
        //check if the date for the event is within this month
        var splitDate = EVENTS[i].StartDate.split('-');
        var EventMonth = splitDate[1];
        if(EventMonth == (currentDateDisplayed.getMonth() + 1)){
            console.log("this event is within the month");
            console.log(EVENTS[i]);
            var EventDay = Number(splitDate[2]);
            var dateID = `dayNumber${EventDay}`;

            var day = document.getElementById(dateID);

            if(day.childNodes.length > 1){
                var eventBox = day.lastChild;
                var numOfEvents = eventBox.childNodes.length;
                var addIcon = document.createElement("div");
                addIcon.className = 'eventIcon';
                addIcon.style.right = `${15*(numOfEvents + 1) + 2*(numOfEvents)}px`;
                addIcon.style.backgroundColor = `#${EVENTS[i].Color}`;
                addIcon.onclick = showData;
                addIcon.value = i;
                eventBox.appendChild(addIcon);
                day.appendChild(eventBox);
            } else {
                //Get the element that we are putting an icon in 
                var eventBox = document.createElement("div");
                eventBox.className = "eventBox";
                //Calculate number of events
                var addIcon = document.createElement("div");
                addIcon.className = 'eventIcon';
                addIcon.style.right = `15px`;
                addIcon.style.backgroundColor = `#${EVENTS[i].Color}`;
                addIcon.onclick = showData;
                addIcon.value = i;
                console.log(EVENTS[i].Color);
                eventBox.appendChild(addIcon);
            
                day.appendChild(eventBox);
            }
            
        }
    }
}

function removeCurrentMonthDisplayed(){
    var parent = document.getElementById("days");
    while (parent.firstChild) {
        parent.removeChild(parent.firstChild);
    }
}

function showData(){
    $("#showEventModal").css('display', 'block');
    var i = $(this).val();
    console.log(`Event Pressed! i=${i}`);
    console.log(EVENTS[i]);

    $("#showTitleOfEvent").val(EVENTS[i].TitleOfEvent);
    $("#ShowallDay").val(EVENTS[i].AllDay);
    $("#ShowstartDate").val(EVENTS[i].StartDate);
    $("#ShowstartTime").val(EVENTS[i].StartTime);
    $("#ShowLocation").val(EVENTS[i].EventLocation);
    $("#Showfriends").val(EVENTS[i].Friends);
    $("#ShownotesWritingArea").val(EVENTS[i].Notes);
    $("#ShoweventColor").val(`#${EVENTS[i].Color}`);
}0

function closeData(){
    $("#showEventModal").css('display', 'none');
}

window.onload = function initialize() {
    var date = new Date();
    var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
    currentDateDisplayed = firstDay;

    //Get current month and display it
    var currentMonth = firstDay.getMonth();
    $("#month").html(MONTHS[currentMonth]);

    loadMonth(date, firstDay);

    //Get all events for the user
    $.ajax({
        method: "POST",
        url: "../PHP/calendar_GetEvents.php",
        dataType: "JSON",
        data: { }
      }).done(function( response ) {
        console.log(response);
        for(var i = 0; i < response.length; i++){
            console.log("response");
            var TitleOfEvent = response[i].TitleOfEvent;
            var StartDate = response[i].StartDate;
            var EndDate = response[i].EndDate;
            var StartTime = response[i].StartTime;
            var EndTime = response[i].EndTime;
            var AllDay = response[i].AllDay;
            var EventLocation = response[i].EventLocation;
            var Friends = response[i].Friends;
            var Notes = response[i].Notes;
            var Color = response[i].Color;

            EVENTS.push({
                TitleOfEvent: TitleOfEvent, 
                StartDate: StartDate, 
                EndDate: EndDate, 
                StartTime: StartTime,
                EndTime: EndTime,
                AllDay: AllDay, 
                EventLocation: EventLocation,
                Friends: Friends,
                Notes: Notes,
                Color: Color
            });
        }
        //Display icons for these events
        displayEventIcons();
      });
    
    //Add event listeners 
    document.addEventListener('click',function(e){
        if(e.target && (e.target.className == 'allDays' || e.target.className == 'eventBox' || e.target.className == 'number')){
              openCreateNewEvent();
         }
    });

    document.getElementById("submitButton").addEventListener('click', createNewEventSave);
    document.getElementById("backArrow").addEventListener('click', decreaseMonth);
    document.getElementById("forwardArrow").addEventListener('click', increaseMonth);
    document.getElementById("ExitShow").addEventListener('click', closeData);

    var form = document.getElementById("createNewEventForm");
    var form2 = document.getElementById("showEventForm");
    function handleForm(event) { event.preventDefault(); }
    form.addEventListener('submit', handleForm);
    form2.addEventListener('submit', handleForm);
    
}
