<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Project Home</title>
        <link rel="stylesheet" href="../CSS/universal.css">
        <link rel="stylesheet" href="../CSS/settings.css">
        <script src="../jquery-3.6.0.js"></script>
        <script src="../JavaScript/settings.js"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="sidenav">
            <a href="calendar.php">
                <img src ="../Images/Calendar.png">
            </a>
            <a href="settings.php">
                <img src="../Images/Settings.png" class="active">
            </a>
        </div>
        <div class="settingsPageContent">
            <div class="settingsTitle">Settings</div>
            <table>
                <tr>
                    <th>Name:</th>
                    <?php
                        $host = "localhost"; 
                        $user = "rsoufi1"; 
                        $pass = "rsoufi1"; 
                        $db = "rsoufi1";
                                 
                        $conn = new mysqli($host, $user, $pass, $db); 
                        if ($conn->connect_error) { 
                            trigger_error(mysqli_error(), E_USER_ERROR); 
                            die("error");
                        }

                        //get name of user
                        $userID = str_replace(' ', '', $_SESSION["SessionUserID"]);

                        $sql = "SELECT username FROM CalendarApp_Users WHERE UserID='$userID'";
                        $result = $conn->query($sql);
                        if($result->num_rows == 1){
                            $row = $result->fetch_assoc();
                            echo '<td>'.$row["username"].'</td>';
                        } else {
                            echo '<td>Name of Person</td>';
                        }

                        $conn->close();
                        ?>
                </tr>
                <tr>
                    <th>Friends:</th>
                    <td><button id="addFriendButton">Add friend</button></td>
                </tr>
                <!--Attatch friends list here-->
                <tr>
                    <td>Friends name</td>
                    <td>Friend user ID</td>
                </tr>
                <?php
                    $host = "localhost"; 
                    $user = "rsoufi1"; 
                    $pass = "rsoufi1"; 
                    $db = "rsoufi1";
                             
                    $conn = new mysqli($host, $user, $pass, $db); 
                    if ($conn->connect_error) { 
                        trigger_error(mysqli_error(), E_USER_ERROR); 
                        die("error");
                    }
                    
                     //get all friends of the user
                    $userID = str_replace(' ', '', $_SESSION["SessionUserID"]);

                    $sql = "SELECT * FROM CalendarApp_FriendList WHERE UserID='$userID'";

                    $result = $conn->query($sql);

                    if ($result->num_rows == 0) {
                        echo '<tr>';
                        echo '<td>No friends</td>';
                        echo '<td>No friends</td>';
                        echo '</tr>';
                    } else {
                        while($row = $result->fetch_assoc()){
                            $friendID = $row["FriendID"];

                            $sqlGetFriendName = "SELECT * FROM CalendarApp_Users WHERE UserID='$friendID'";
                            $result2 = $conn->query($sqlGetFriendName);

                            if($result2->num_rows != 0){
                                $friendInfo = $result2->fetch_assoc();
                                echo '<tr>';
                                echo '<td>'.$friendInfo["username"].'</td>';
                                echo '<td>'.$friendInfo["UserID"].'</td>';
                                echo '</tr>';
                            }
                        }
                    }

                    $conn->close();
                ?>
            </table>
        </div>

        <div class="addFriendModal" id="addFriendModal">
            <div class="addFriendModalContent">
                <div class="enterIDLabel">Enter friend's User ID:</div>
                <input id="friendID" type="text">
                <div id="results"></div>
                <button id="submitFriendId">Submit</button>
            </div>
        </div>
    </body>
</html>