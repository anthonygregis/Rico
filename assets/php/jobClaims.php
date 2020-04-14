<?php 
require_once dirname( __FILE__ ) . '/' . "../config/config.php";

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if(isset($job)) {
    $query = "SELECT * FROM crimeClaims WHERE crimeUuid = '$job'";
}

$result = mysqli_query($link, $query) or die(mysqli_error($link));
$tableArray = array();
$counter = 0;
while ($row = mysqli_fetch_array($result))
{
     $tableArray[$counter]['workerClaims'] = $counter;
     $counter++;
}

//Close Connection
mysqli_close($link);
?>