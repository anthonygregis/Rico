<?php

if (session_id() === "") {
    session_id('ricoTracking');
    session_start();
}
  
$_SESSION['userUuid'] = "1";
$_SESSION['userIdentifier'] = "Bananas";
$_SESSION['userContractor'] = 1;

?>