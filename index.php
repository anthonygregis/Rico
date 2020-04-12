<?php
// Initialize the session
session_start();

if(isset($_GET["sort"])) { 
    $sort = $_GET["sort"];
}
require_once 'assets/php/jobs.php';

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>
<html>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, intial-scale=1, shrink-to-fit=no">
    <!-- This website is an education recreation of ideas from Westworld -->
    <head>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/fonts/circular-std/style.css">
        <link rel="stylesheet" href="assets/css/dabcoin.style.css">
        <link rel="stylesheet" href="assets/fonts/fontawesome/css/fontawesome-all.css">
        <link rel="stylesheet" href="assets/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
        <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    </head>
    <?php if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true) : ?>
    <body>
        <div class="header">
            <div class="glitch" data-text="RI₵O">RI₵O</div>
        </div>
        <section class="intro">
                <p>Rico is designed to allow discreet contracts to be carried out between employers and workers. Designed to protect both parties and achieve maximum effeciency.
                    Employing a reputation system for both parties to ensure that you are rewarded for providing / completing contracts effectively.</p> 
                <br>
                <input type="text" id="referral" name="referral" placeholder="Enter Refferal Code..">
        </section>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
		<script>
            var input = document.getElementById("referral");
            input.addEventListener("keyup", function(event) {
              if (event.keyCode === 13) {
               event.preventDefault();
               window.location.href = "http://nopixel.online/rico?loggedin=true";
              }
            });
        </script>
    </body>
    <?php endif; ?>
    <!-- IF PERSON IS LOGGED IN IT DISPLAYS BELOW -->
    <?php if((!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) && !isset($_GET["job"])) : ?>
    <body>
        <div class="header">
            <div class="glitch" data-text="RI₵O">RI₵O</div>
            <!-- <div class="styled-select slate">
                <select onchange="window.location=this.value">
                    <option value="" disabled selected>Sort</option>
                    <option value="?sort=time">Time</option>
                    <option value="?sort=value">Value</option>
                    <option value="?sort=rep">Seller Rep</option>
                </select>
            </div> -->
            <input type="text" name="search" placeholder="Search..">
        </div>
        <br>
        <section class="cd-timeline js-cd-timeline">
            <div class="cd-timeline__container">
                <?php $i = 1; foreach($tableArray as $row) {?>
                <div class="cd-timeline__block js-cd-block">
                <a href="?job=<?php echo $row['crimeUuid'] ?>">
                    <div class="cd-timeline__img cd-timeline__img--picture js-cd-img">
                        <p>$</p>
                    </div>
                    <div class="cd-timeline__content js-cd-content <?php if($row['sponsoredJob'] == 1) { echo "sponsored"; } ?>">
                        <h3><strong><?php echo $row['crime'] ?></strong></h3>
                        <p><strong><?php echo time_elapsed_string($row['crimeTime']) ?></strong> NEED TO ADD CRIME ICONS</p>
                    </div>
                    </a>
                </div>
                <?php } ?>
            </div>
        </section>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
		<script>
            var input = document.getElementById("referral");
            input.addEventListener("keyup", function(event) {
              if (event.keyCode === 13) {
               event.preventDefault();
               window.location.href = "https://nopixel.online/rico?loggedin=true";
              }
            });
        </script>
    </body>
    <?php endif; ?>
    <?php if(isset($_GET["job"])) : ?>
        <body>
        <div class="header">
            <div class="glitch" data-text="RI₵O">RI₵O</div>
            <button class="styled" type="button" onclick="window.location.href='https://nopixel.online/rico/test/index.php'">Return</button>
            <!-- <div class="styled-select slate">
                <select onchange="window.location=this.value">
                    <option value="" disabled selected>Sort</option>
                    <option value="?sort=time">Time</option>
                    <option value="?sort=value">Value</option>
                    <option value="?sort=rep">Seller Rep</option>
                </select>
            </div> 
            <input type="text" name="search" placeholder="Search.."> -->
        </div>
        <br>
        <section class="job-details">
            <p>Your job details are the following:</p>
        </section>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
		<script>
            var input = document.getElementById("referral");
            input.addEventListener("keyup", function(event) {
              if (event.keyCode === 13) {
               event.preventDefault();
               window.location.href = "http://nopixel.online/rico?loggedin=true";
              }
            });
        </script>
    </body>
    <?php endif; ?>
</html>