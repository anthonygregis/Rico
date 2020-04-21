<?php

require_once __DIR__.'/../darkweb/tracker.php';

if($_SESSION['userIdentifier'] !== "watcher") {
    if(isset($create)) {
        $url = "Rico | Create A Job";
    } elseif(isset($job)) {
        $url = "Rico | Viewed a Job";
    } elseif(isset($claimJob)) {
        $url = "Rico | Claimed a Job";
    } elseif(isset($completeJob)) {
        $url = "Rico | Completed a Job";
    } elseif(isset($award)) {
        $url = "Rico | Awarded a Worker";
    } elseif(isset($closeJob)) {
        $url = "Rico | Closed a Job";
    } else {
        $url = "Rico";
    }
    

    $escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );

    trackVisit($_SESSION['userUuid'], $_SESSION['userIdentifier'], $escaped_url);
}

?>