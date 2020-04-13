<?php
// Initialize the session
session_start();

if(isset($_GET["loggedin"])) {
  $loggedin = true;
}

if(isset($_GET["sort"])) { 
  $sort = $_GET["sort"];
}

if(isset($_GET["job"])) { 
  $job = $_GET["job"];
  require_once 'assets/php/jobDetail.php';
} else {
  require_once 'assets/php/jobs.php';
}

require_once 'assets/php/time_elapsed.php';
require_once 'assets/php/twitch_clip_strip.php';

?>
<html >
<head>
  <meta charset="UTF-8">
  <title>RI₵O</title>
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Droid+Sans'>
  <link rel="stylesheet" href="assets/css/main.css">
</head>
<?php if(!isset($_GET["job"])) : ?>
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
    </div>
    <input type="text" name="search" placeholder="Search.."> -->
  </div>
  <div class="entries">
  <?php $i = 1; foreach($tableArray as $row) {?>
      <div class="entry">
        <a href="?job=<?php echo $row['crimeUuid'] ?>">
        <div class="title big <?php if($row['sponsoredJob'] == 1) { echo "talon"; } if($row['sponsoredJob'] == 2) { echo "gnome"; } ?>"><?php if($row['sponsoredJob'] == 1) : ?><img class="image-talon" width="15%" src="assets/img/talon.png"/><?php endif; ?><?php if($row['sponsoredJob'] == 2) : ?><img class="image-talon" width="15%" src="assets/img/gnome.png"/><?php endif; ?><?php echo $row['crime'] ?></div>
        <div class="body">
          <p><?php echo time_elapsed_string($row['crimeTime']) ?></strong></p>
        </div>
        </a>
      </div>
  <?php } ?>
</div>
<script src="assets/js/index.js"></script>
</body>
<?php endif; ?>
<?php if(isset($job)) : ?>
<body>
  <div class="header">
    <div class="glitch" data-text="RI₵O">RI₵O</div>
    <input type="button" value="Return" onclick="window.location.href = 'https://nopixel.online/rico/test/index.php';">
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
  <?php $i = 1; foreach($tableArray as $row) {?>
  <section class="intro">
        <p>-- Retrieved Job Information --</p>
        <p>Job Type: <?php echo $row['crime'] ?></p>
        <p>Job UUID: <?php echo $row['crimeUuid'] ?></p> 
        <p>Job Description: <?php echo $row['crimeDescription'] ?></p> 
        <p>Worker Limit: <?php echo $row['workerLimit'] ?></p> 
        <!-- <p>Sponsored Worker: <?php if($row['sponsoredJob'] == 1) {echo "Talon";} if($row['sponsoredJob'] == 2) {echo "Gnomes";} ?></p> --> 
        <p>Payment Type: <?php echo $row['paymentType'] ?></p> 
        <p>Payment Amount: <?php echo $row['paymentAmount'] ?></p> 
        <p>Posted At: <?php echo $row['crimeTime'] ?></p> 
        <video width="80%" autoplay loop><source src="<?php

$URL = "https://clips.twitch.tv/BlatantAmusedArmadilloThunBeast";
$Fetched_Contents = file_get_contents($URL);
if (preg_match('/src="(.*?).mp4(.*?)"/i', $Fetched_Contents, $MP4_Link)){
    $Complete_MP4_Link = "{$MP4_Link[2]}.mp4{$MP4_Link[3]}";
    echo $Complete_MP4_Link;
}else{
    echo "Didn't found any mp4 link.";
}

?>" type="video/mp4"></video>
      <br>
  </section>
  <?php } ?>
<script src="assets/js/index.js"></script>
</body>
<?php endif; ?>
</html>
