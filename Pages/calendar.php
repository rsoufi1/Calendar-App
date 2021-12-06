<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Project Home</title>
        <link rel="stylesheet" href="../CSS/universal.css">
        <link rel="stylesheet" href="../CSS/calendar.css">
        <script src="../jquery-3.6.0.js"></script>
        <script src="../JavaScript/calendar.js"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    </head>
    <body>
        <!--Create table if not already done-->
        <?php 
            //Create table if not created yet
            $host = "localhost"; 
            $user = "rsoufi1"; 
            $pass = "rsoufi1"; 
            $db = "rsoufi1";
            
            $conn = new mysqli($host, $user, $pass, $db); 
            if ($conn->connect_error) { 
                trigger_error(mysqli_error(), E_USER_ERROR); 
                die("error");
            } 
            
            //Create table
            if ($conn->query("DESCRIBE `CalendarApp_Events`")) {
            } else {
                 //sql to create table 
                 //figure out best method of holding 
                 $sql = "CREATE TABLE CalendarApp_Events (
                    UserID VARCHAR(10),
                    TitleOfEvent VARCHAR(30) NOT NULL,
                    StartDate DATE,
                    EndDate DATE,
                    StartTime TIME,
                    EndTime TIME,
                    AllDay BOOLEAN,
                    EventLocation VARCHAR(50),
                    Friends VARCHAR(100), 
                    Notes VARCHAR(500),
                    Color CHAR(6)
                    )";

                $result = $conn->query($sql);
            }
        
            $conn->close();
        ?>
        <div class="calendarPage" id="calendarPage">
            <div class="sidenav">
                <a href="calendar.php">
                    <img src ="../Images/Calendar.png" class="active">
                </a>
                <a href="settings.php">
                    <img src="../Images/Settings.png">
                </a>
            </div>
            <div class="header">
                <input type="image" src="../Images/Back arrow.png" id="backArrow">
                <div class="month" id="month">Month</div>
                <input type="image" src="../Images/Front arrow.png" id="forwardArrow">
                <button onclick="openCreateNewEvent()" id="createNewEventButton">Create Event</button>
            </div>
            <div class="calendar">
                <div class="daysOfWeek">
                    <div class="dayOfWeek">Sunday</div>
                    <div class="dayOfWeek">Monday</div>
                    <div class="dayOfWeek">Tuesday</div>
                    <div class="dayOfWeek">Wednesday</div>
                    <div class="dayOfWeek">Thursday</div>
                    <div class="dayOfWeek">Friday</div>
                    <div class="dayOfWeek">Saturday</div>
                </div>
                <div class="days" id="days">
                </div>
            </div>
        </div>
        <div class="createNewEvent" id="createNewEvent">
            <form id="createNewEventForm" class="hide">
                <!--Title-->
                <input type="text" id="titleOfEvent" name="titleOfEvent" placeholder="Title of Event" maxlength="30"><br/>
                
                <!--Start Date and End Date-->
                <table>
                    <tr>
                        <td>Date:</td>
                        <!--<td>End Date:</td>-->
                        <td><input type="checkbox" id="allDay" name="allDay">
                            <label for="allDay">All Day</label></td>
                    </tr>
                    <tr>
                        <td><input type="date" id="startDate" name="startDate"></td>
                    </tr>
                    <tr>
                        <td><input type="time" id="startTime" name="startTime"></td>
                    </tr>
                </table>

                <!--Location-->
                <div class="locationTitle">
                    <img src="../Images/Location.png">
                    <div>Location</div>
                </div>
                <input type="text" id="Location" name="Location" maxlength="50"><br/>

                <!--Friends-->
                <div class="friendsTitle">
                    <img src="../Images/friends.png">
                    <div>Add Friends</div>
                </div>
                <input type="text" id="friends" name="friends" maxlength="100"><br/>


                <!--Notes-->
                <div class="notesTitle">Notes:</div>
                <div class="notes">
                    <div class="notesWritingArea" id="notesWritingArea" contenteditable="true" maxlength="500">

                    </div>

                </div>

                <br>
                <div class="eventColor">
                    <div class="eventColorTitle">Select event color:</div>
                    <input type="color" id="eventColor" value="#ff0000">
                </div>

                <button id="submitButton">Submit</button>
            </form>
        </div>

        <div class="showEventModal" id="showEventModal">
            <div class="showEventModalContent">
            <form id="showEventForm">
                <!--Title-->
                <input type="text" id="showTitleOfEvent" placeholder="Title of Event" maxlength="30"><br/>
                
                <!--Start Date and End Date-->
                <table>
                    <tr>
                        <td>Date:</td>
                        <!--<td>End Date:</td>-->
                        <td><input type="checkbox" id="ShowallDay">
                            <label for="allDay">All Day</label></td>
                    </tr>
                    <tr>
                        <td><input type="date" id="ShowstartDate"></td>
                    </tr>
                    <tr>
                        <td><input type="time" id="ShowstartTime"></td>
                    </tr>
                </table>

                <!--Location-->
                <div class="locationTitle">
                    <img src="../Images/Location.png">
                    <div>Location</div>
                </div>
                <input type="text" id="ShowLocation" maxlength="50"><br/>

                <!--Friends-->
                <div class="friendsTitle">
                    <img src="../Images/friends.png">
                    <div>Add Friends</div>
                </div>
                <input type="text" id="Showfriends" maxlength="100"><br/>


                <!--Notes-->
                <div class="notesTitle">Notes:</div>
                <div class="notes">
                    <div class="notesWritingArea" id="ShownotesWritingArea" contenteditable="true" maxlength="500">

                    </div>

                </div>

                <br>
                <div class="eventColor">
                    <div class="eventColorTitle">Select event color:</div>
                    <input type="color" id="ShoweventColor" value="#ff0000">
                </div>
            </form>
            <div>
                <br>
                <button id="ExitShow">Exit</button>
                </div>
            </div>
        </div>
    </body>
</html>