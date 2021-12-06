<?php
    session_start();
    $host = "localhost"; 
    $user = "rsoufi1"; 
    $pass = "rsoufi1"; 
    $db = "rsoufi1";
            
    $conn = new mysqli($host, $user, $pass, $db); 
    if ($conn->connect_error) { 
        trigger_error(mysqli_error(), E_USER_ERROR); 
        die("error");
    } 

    //Insert data
    $title = strval($_POST['title']);
    $startDate = strval($_POST['startDate']);
    $endDate = strval($_POST['endDate']);
    $startTime = strval($_POST['startTime']);
    $endTime = strval($_POST['endTime']);
    $allDay = strval($_POST['allDay']);
    $eventLocation = strval($_POST['eventLocation']);
    $friends = strval($_POST['friends']);
    $notes = strval($_POST['notes']);
    $color = strval($_POST['color']);

    //Get user ID
    $userID = str_replace(' ', '', $_SESSION["SessionUserID"]);

    //Insert all the data into a table
    $sql = 'INSERT INTO CalendarApp_Events (UserID, TitleOfEvent, StartDate, EndDate, StartTime, EndTime, AllDay, EventLocation, Friends, Notes, Color)
            VALUES("'.$userID.'", "'.$title.'", "'.$startDate.'", "'.$endDate.'", "'.$startTime.'", "'.$endTime.'", "'.$allDay.'", "'.$eventLocation.'", "'.$friends.'", "'.$notes.'", "'.$color.'")';

    if($conn->query($sql) === TRUE) {
        echo true;
    } else {
        echo false;
    }

    //close connection
    $conn->close();
?>