<?php

require_once dirname( __FILE__ ) . '/' . "../config/config.php";

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$query = "UPDATE crimes SET crimeCompleted = 1 WHERE crimeUuid=?";

if($stmt = mysqli_prepare($link, $query)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "s", $crimeUuid);

    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        header('Location: https://nopixel.online/rico/');
    } else {
        echo "Error: 0x001 | Refresh browser and report bug in chatters anonymous";
    }

    // Close statement
    mysqli_stmt_close($stmt);

} else {
    echo "That SQL be fucked";
}

$query = "";
$link = "";
$stmt = "";

$query = "UPDATE criminals SET userRep = userRep + 10 WHERE userUuid=?";

if($stmt = mysqli_prepare($link, $query)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "s", $sellerUuid);

    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        
    } else {
        echo "Error: 0x001 | Refresh browser and report bug in chatters anonymous";
    }

    // Close statement
    mysqli_stmt_close($stmt);

} else {
    echo "That SQL be fucked";
}

$query = "";
$link = "";
$stmt = "";

$query = "UPDATE criminals SET userRep = userRep + 10 WHERE userUuid=?";

if($stmt = mysqli_prepare($link, $query)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "s", $workerUuid);

    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        
    } else {
        echo "Error: 0x001 | Refresh browser and report bug in chatters anonymous";
    }

    // Close statement
    mysqli_stmt_close($stmt);

} else {
    echo "That SQL be fucked";
}

//Close Connection
mysqli_close($link);
?>