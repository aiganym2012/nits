<?php
$station = $_POST['station'];
$date = $_POST['date'];
$time = $_POST['time'];
$lvl = $_POST['lvl'];
$high = $_POST['high'];
$dirper = $_POST['dirper'];

if (!empty($station) || !empty($date) || !empty($time) || !empty($lvl) || !empty($high) || !empty($dirper)) {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "nits";

    //create connection 
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

    if (mysqli_connect_error()){
        die('Connect Error(' . mysqli_connect_error() . ')' . mysqli_connect_error());
    } else{
        $Select = "SELECT dirper From db Where dirper = ? Limit 1";
        $Insert = "INSERT Into db (station, date, time, lvl, high, dirper) values(?, ?, ?, ?, ? , ?)";

        //preparing statement 

        $stmt = $conn->prepare($Select);
        $stmt->bind_param("s", $dirper);
        $stmt->execute();
        $stmt->bind_result($dirper);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if ($rnum==0){
            $stmt->close();
            $stmt = $conn->prepare($Insert);
            $stmt->bind_param("ssssii", $station, $date, $time, $lvl, $high, $dirper);
            $stmt->execute();
            echo "New record inserted sucessfully";

        } else {
            echo "Already exist";
        }
        $stmt->close();
        $conn->close();
    }

} else {
    echo "All field are required";
    die();
}
?>



