<?php

require_once dirname( __FILE__ ) . '/' . "../config/config.php";
require_once 'uuidGenerate.php';

$errors = array();

if($_SERVER["REQUEST_METHOD"] == "POST"){

    /* Attempt to connect to MySQL database */
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    $query = "INSERT INTO crimes (crime, crimeUuid, crimeDescription, crimeUrl, sellerUuid, workerLimit, paymentType, paymentAmount, sponsoredJob) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $crime = mysqli_real_escape_string($link, $_POST['crime']);
    $crimeUuid = gen_uuid();
    $crimeDescription = mysqli_real_escape_string($link, $_POST['crimeDescription']);
    if(isset($_POST['crimeUrl'])) { $crimeUrl = $_POST['crimeUrl']; } else { $crimeUrl = null ; }
    $sellerUuid = $_POST['sellerUuid'];
    $workerLimit = $_POST['workerLimit'];
    $paymentType = mysqli_real_escape_string($link, $_POST['paymentType']);
    $paymentAmount = $_POST['paymentAmount'];
    if ($sellerUuid == "5bb198f8-b90b-40b3-81f5-d78347f7d1f8") { $sponsoredJob = 1; } elseif ($sellerUuid == "f064ebed-58d0-4658-9d95-1bdfbc1d1d3f") { $sponsoredJob = 2; } else { $sponsoredJob = 0; }

    if (empty($crime)) { array_push($errors, "Crime name is required"); }
    if (empty($crimeUuid)) { array_push($errors, "UUID generation failed, please try again.."); }
    if (empty($crimeDescription)) { array_push($errors, "Crime Description is required"); }
    if (empty($sellerUuid)) { array_push($errors, "Seller UUID failed to retrieve, please try again.."); }
    if (empty($workerLimit)) { array_push($errors, "Active contract limit is required"); }
    if (empty($paymentType)) { array_push($errors, "Payment type is required"); }
    if (empty($paymentAmount)) { array_push($errors, "Payment Amount is required"); }
    if (empty($sponsoredJob)) { array_push($errors, "Failure to check contractor status, please try again..."); }

    if($stmt = mysqli_prepare($link, $query)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sssssisii", $crime, $crimeUuid, $crimeDescription, $crimeUrl, $sellerUuid, $workerLimit, $paymentType, $paymentAmount, $sponsoredJob);

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            header('Location: https://nopixel.online/rico/index.php?job=' . $crimeUuid);
        } else {
            echo "Error: 0x002 | Refresh browser and report bug in chatters anonymous";
        }

        // Close statement
        mysqli_stmt_close($stmt);

    //Close Connection
    mysqli_close($link);
    }
}

?>