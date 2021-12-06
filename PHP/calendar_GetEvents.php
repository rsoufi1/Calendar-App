<?php
    session_start();
    //connect
    $host = "localhost"; 
    $user = "rsoufi1"; 
    $pass = "rsoufi1"; 
    $db = "rsoufi1";
            
    $conn = new mysqli($host, $user, $pass, $db); 
    if ($conn->connect_error) { 
        trigger_error(mysqli_error(), E_USER_ERROR); 
        die("error");
    } 

    //Get user ID
    $userID = str_replace(' ', '', $_SESSION["SessionUserID"]);

    //get all events from the user
    $sql = "SELECT * FROM CalendarApp_Events WHERE UserID='$userID' ORDER BY StartDate";

    $result = $conn->query($sql);
    $returnArray = [];

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $returnArray[] = array(
                "TitleOfEvent"=>$row["TitleOfEvent"], 
                "StartDate"=>$row["StartDate"],
                "EndDate"=>$row["EndDate"],
                "StartTime"=>$row["StartTime"],
                "EndTime"=>$row["EndTime"],
                "AllDay"=>$row["AllDay"],
                "EventLocation"=>$row["EventLocation"],
                "Friends"=>$row["Friends"],
                "Notes"=>$row["Notes"],
                "Color"=>$row["Color"]);
        }
    } else {
        echo "no results";
    }

    echo json_encode($returnArray);

    $conn->close();
?>