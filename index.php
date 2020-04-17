<?php
// Initialize the session
session_start();

require_once __DIR__.'/../darkweb/tracker.php';

$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

$escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );

trackVisit($_SESSION['userUuid'], $_SESSION['userIdentifier'], $escaped_url);

if(isset($_SESSION["userUuid"])) {
  $loggedin = true;
}

if(isset($_GET['claimJob'])) {
  $job = $_GET["claimJob"];
  $claimJob = $_GET["claimJob"];
  $userUuid = $_SESSION['userUuid'];
  $crimeUuid = $_GET['claimJob'];
  require_once 'assets/php/jobClaim.php';
  require_once 'assets/php/jobDetail.php';
  require_once 'assets/php/recursive_in_array.php';
}

if(isset($_GET["job"])) { 
  $job = $_GET["job"];
  require_once 'assets/php/jobDetail.php';
  require_once 'assets/php/recursive_in_array.php';
} else {
  require_once 'assets/php/jobs.php';
}

require_once 'assets/php/time_elapsed.php'

?>
<html >
<head>
  <meta charset="UTF-8">
  <title>RI₵O</title>
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Droid+Sans'>
  <script src="https://kit.fontawesome.com/7d71860d85.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="assets/css/main.css">
  <script src="assets/js/index.js"></script>
</head>

<!-- JOB BOARD -->

<<<<<<< Updated upstream
<?php if(!isset($_GET["job"])) : ?>
=======
<?php if(empty($_GET) && (!$loggedin)) : ?>
>>>>>>> Stashed changes
<body>
  <div class="header">
    <div class="glitch" data-text="RI₵O">RI₵O</div>
    <?php if($_SESSION['userContractor'] == 1) : ?><a style="color:red;" href="?create"><i class="far fa-plus-square"></i></a><?php endif; ?>
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
<<<<<<< Updated upstream

<script src="assets/js/index.js"></script>

=======
>>>>>>> Stashed changes
</body>
<?php endif; ?>

<!-- JOB DETAILS -->

<?php if(isset($job) || isset($claimJob)) : ?>
<body>
  <div class="header">
    <div class="glitch" data-text="RI₵O">RI₵O</div>
<<<<<<< Updated upstream
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
=======
    <input type="button" value="Return" onclick="location.href='<?php echo $_SERVER[PHP_SELF]; ?>';">
>>>>>>> Stashed changes
  </div>
    <?php if (($sellerUuid == $_SESSION['userUuid'])) : ?>
      <section class="jobDetails">
        <h1 class="center"><?php echo $crime ?></h1>
        <h4 class="center">Posted: <?php echo time_elapsed_string($crimeTime) ?></h4> 
        <p>Job UUID: <?php echo $crimeUuid ?></p> 
        <p>Job Description: <?php echo $crimeDescription ?></p> 
        <p>Worker Limit: <?php echo $crimeLimit ?></p>
        <p>Current Claims: <?php echo $crimeClaims ?></p> 
        <p>Payment Type: <?php echo $paymentType ?></p> 
        <p>Payment Amount: <?php echo $paymentAmount ?></p>
        <br>
        <hr style="border-color: inherit;">
        <h4 class="center">Current Claims</h4>
        <?php $i = 1; foreach($tableArray as $row) {?>
          <p>Worker UUID: <?php echo $row['workerUuid'] ?></p>
          <p>Claimed At: <?php echo time_elapsed_string($row['claimTime']) ?></p>
          <p><button class="action" onclick="location.href='?job=<?php echo $crimeUuid ?>&awardWorker=<?php echo $row['workerUuid'] ?>';">Award Claim</button>
             <button class="action" onclick="location.href='?job=<?php echo $crimeUuid ?>&reportWorker=<?php echo $row['workerUuid'] ?>';">Report Worker</button></p>
        <?php } ?>
      </section>
    <?php endif; ?>
    <?php if (($sellerUuid !== $_SESSION['userUuid'])) : ?>
      <section class="jobDetails">
        <h1 class="center"><?php echo $crime ?></h1>
        <h4 class="center">Posted: <?php echo time_elapsed_string($crimeTime) ?></h4> 
        <p>Job UUID: <?php echo $crimeUuid ?></p> 
        <p>Job Description: <?php echo $crimeDescription ?></p> 
        <p>Worker Limit: <?php echo $crimeLimit ?></p>
        <p>Current Claims: <?php echo $crimeClaims ?></p> 
        <p>Payment Type: <?php echo $paymentType ?></p> 
        <p>Payment Amount: <?php echo $paymentAmount ?></p>
        <center>
         <?php if(($crimeClaims < $crimeLimit) && (!in_array_r($_SESSION['userUuid'], $tableArray))) : ?>
          <button class="action" onclick="location.href='?claimJob=<?php echo $crimeUuid ?>';">Claim Job</button>
         <?php endif; ?>
         <?php if((in_array_r($_SESSION['userUuid'], $tableArray))) : ?>
          <button class="action">Mark Complete</button>
         <?php endif; ?>
        </center>
      </section>
    <?php endif; ?>

</body>
<?php endif; ?>

</html>
