<?php

require_once __DIR__.'/../darkweb/tracker.php';

if($_SESSION['userIdentifier'] !== "watcher") {
    $url =  "Rico";

    $escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );

    trackVisit($_SESSION['userUuid'], $_SESSION['userIdentifier'], $escaped_url);
}

?>