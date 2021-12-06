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
    $userID = strval($_POST['userID']);
    $password = strval($_POST['password']);

    //Check if USERID is unique 
    $sql = "SELECT * FROM CalendarApp_Users WHERE UserID='$userID'";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        echo false;
    } else {
        $row = $result->fetch_assoc();
        if(strcmp($row['user_password'], $password) == 0){
            echo true;
            $_SESSION["SessionUserID"] = $userID;
        } else{
            echo false;
        }
    }

    //close connection
    $conn->close();
?>