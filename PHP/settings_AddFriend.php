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

    //create table if not already created
    if ($conn->query("DESCRIBE `CalendarApp_FriendList`")) {
        echo "table exists";
    } else {
         //sql to create table 
         $sql = "CREATE TABLE CalendarApp_FriendList (
            UserID VARCHAR(10),
            FriendID VARCHAR(10)
            )";

        if($conn->query($sql)){
            echo "table created";
        } else {
            echo "Error: ".$conn->error;
        }

    }

    //Check if the friend ID is a valid userID
    $friendID = str_replace(' ', '', $_POST['friendID']);
    echo $friendID;
    $sql = "SELECT * FROM CalendarApp_Users WHERE UserID='$friendID'";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        echo "no user of that ID";
    } else {
        //If valid, add friendID to friends list
        echo "there is a user with this ID";
        //get user id
        $userID = str_replace(' ', '', $_SESSION["SessionUserID"]);

        $sql = 'INSERT INTO CalendarApp_FriendList (UserID, FriendID)
                VALUES("'.$userID.'", "'.$friendID.'")';

        if($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: ".$conn->error;
        }

        $sql = 'INSERT INTO CalendarApp_FriendList (UserID, FriendID)
        VALUES("'.$friendID.'", "'.$userID.'")';

        if($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: ".$conn->error;
        }
    }

    $conn->close();
?>