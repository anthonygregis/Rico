<?php

if(isset($_SESSION["userUuid"])) {
  $loggedin = true;
}

if(isset($_GET['create'])) {
  $create = true;
  require_once 'assets/php/jobPost.php';
}

if(isset($_GET["job"])) { 
  $job = $_GET["job"];
  require_once 'assets/php/jobDetail.php';
  require_once 'assets/php/recursive_in_array.php';
  $i = 1; foreach($tableArray as $row) { 
    if(($row['workerUuid'] == $_SESSION["userUuid"]) && ($row['crimeCompleted'] == 1)) { 
      $crimeCompleted = true;
    } elseif(($row['workerUuid'] == $_SESSION["userUuid"]) && ($row['crimeCompleted'] == 0)) {
      $crimeCompleted = false;
    }
  }
} else {
  require_once 'assets/php/jobs.php';
}

if(isset($_GET['claimJob'])) {
    $job = $_GET["claimJob"];
    $claimJob = $_GET["claimJob"];
    $userUuid = $_SESSION['userUuid'];
    $userIdentifier = $_SESSION['userIdentifier'];
    $crimeUuid = $_GET['claimJob'];
    require_once 'assets/php/jobClaim.php';
    require_once 'assets/php/jobDetail.php';
    require_once 'assets/php/recursive_in_array.php';
}

if(isset($_GET['completeJob'])) {
    $job = $_GET['completeJob'];
    $completeJob = $_GET["claimJob"];
    $userUuid = $_SESSION['userUuid'];
    $crimeUuid = $_GET['claimJob'];
    require_once 'assets/php/jobComplete.php';
    require_once 'assets/php/jobDetail.php';
}

if(isset($_GET['awardWorker'])) {
  $award = true;
}

if(isset($_GET['closeJob'])) {
  $closeJob = true;
  $workerUuid = $_GET['workerUuid'];
  $crimeUuid = $_GET['closeJob'];
  $sellerUuid = $_SESSION['userUuid'];
  require_once 'assets/php/jobClose.php';
}

?>