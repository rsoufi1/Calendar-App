<!DOCTYPE html>
<html>
    <head>
        <title>Create New Account</title>
        <link rel="stylesheet" href="../CSS/createNewAccount.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
        <script src="../jquery-3.6.0.js"></script>
        <script src="../JavaScript/createNewAccount.js"></script>
    </head>
    <body>
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
            
            if ($conn->query("DESCRIBE `CalendarApp_Users`")) {
            } else {
                 //sql to create table 
                 $sql = "CREATE TABLE CalendarApp_Users (
                    UserID VARCHAR(10) PRIMARY KEY,
                    username VARCHAR(30) NOT NULL,
                    user_password VARCHAR(30) NOT NULL
                    )";

                $result = $conn->query($sql);

            }
        
            $conn->close();
        ?>
        <div class="createNewAccountPage">
        <div class="createNewAcocuntContainer">
            <form id="createNewEventForm">
                <label for="name">Your name:</label>
                <input id="name" type="text" placeholder="first last">
                <label for="username">Create Username:</label>
                <input id="username" type="text" placeholder="username">
                <label for="password">Create Password:</label>
                <input id="password" type="text" placeholder="password"><br>
                <button id="createNewAccountBtn">Create New Account</button>
            </form>
        </div>
        </div>
    </body>
</html>