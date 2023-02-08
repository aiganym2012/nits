<?php
$station = $_GET['station'];
$date = $_GET['date'];
$time = $_GET['time'];
$lvl = $_GET['lvl'];
$high = $_GET['high'];
$dirper = $_GET['dirper'];

$conn = mysqli_connect("localhost", "root", "", "nits")
if (!$conn) {
    die("Error " . mysqli_connect_error());
}


$sql = "Select * From id";
if($result = mysqli_query($conn, $sql)){

    $rowsCount = mysqli_num_rows($result);
    echo "<p>Получено обьектов: $rowsCount</p>";
    echo "<table><tr><th>Id</th><th>Station><th>lvl</th></tr>";
    foreach($result as $row){
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["station"] . "</td>";
        echo "<td>" . $row["lvl"] . "</td>";
        echo "</tr>"
    }
    echo "</table>";
    mysqli_free_result($result);
} else{
    echo "Error: " . mysqli_error($conn);
}
mysqli_close($conn);



?>