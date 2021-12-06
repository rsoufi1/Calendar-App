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
    $name = strval($_POST['userName']);
    $userID = str_replace(' ', '', strval($_POST['userID']));
    $password = strval($_POST['password']);

    //Check if USERID is unique 
    $sql = "SELECT * FROM CalendarApp_Users WHERE UserID='$userID'";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        $sql2 = 'INSERT INTO CalendarApp_Users (UserID, username, user_password)
                VALUES("'.$userID.'", "'.$name.'", "'.$password.'")';

        if($conn->query($sql2) === TRUE) {
            $_SESSION["SessionUserID"] = $userID;
            echo true;
        } else {
            echo "Error: ".$conn->error;
        }
    } else {
        echo false;
    }

    //close connection
    $conn->close();
?>