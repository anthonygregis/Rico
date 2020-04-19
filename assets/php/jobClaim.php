<?php

require_once dirname( __FILE__ ) . '/' . "../config/config.php";

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$query = "INSERT INTO crimeClaims (crimeUuid, workerUuid, workerIdentifier) VALUES (?, ?, ?)";

if($stmt = mysqli_prepare($link, $query)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "sss", $crimeUuid, $userUuid, $userIdentifier);

    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        header('Location: ?job=' . $crimeUuid);
    } else {
        echo "Error: 0x001 | Refresh browser and report bug in chatters anonymous";
    }

    // Close statement
    mysqli_stmt_close($stmt);

//Close Connection
mysqli_close($link);

}

?>