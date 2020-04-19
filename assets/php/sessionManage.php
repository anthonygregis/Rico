<?php

if (session_id() === "") {
    session_id('ricoTracking');
    session_start();
}

?>