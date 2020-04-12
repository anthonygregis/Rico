<?php 
require_once dirname( __FILE__ ) . '/' . "../config/config.php";

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$query = "SELECT * FROM jobs ORDER BY sponsoredJob DESC, crimeTime DESC";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
$tableArray = array();
$counter = 0;
while ($row = mysqli_fetch_array($result))
{
     $tableArray[$counter]['crime'] = $row['crime'];
     $tableArray[$counter]['crimeUuid'] = $row['crimeUuid'];
     $tableArray[$counter]['paymentType'] = $row['paymentType'];
	 $tableArray[$counter]['paymentAmount'] = $row['paymentAmount'];
     $tableArray[$counter]['crimeTime'] = date('M d h:i A',strtotime($row['crimeTime']));
     $counter++;
}

//Close Connection
mysqli_close($link);
?>