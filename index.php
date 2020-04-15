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
</head>

<!-- JOB BOARD -->

<?php if(!isset($_GET["job"])) : ?>
<body>

  <div class="header">
    <div class="glitch" data-text="RI₵O">RI₵O</div>
    <a style="color:red;" href="?login"><i class="fas fa-sign-in-alt"></i></a>
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

<!-- JOB DETAILS -->

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
    <?php if ($sellerUuid == $_SESSION['userUuid']) : ?>
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
          <p><button class="action">Award Claim</button><button class="action">Report Worker</button></p>
        <?php } ?>
      </section>
    <?php endif; ?>
    <?php if (($sellerUuid !== $_SESSION['userUuid']) && ($crimeClaims < $crimeLimit) && (!in_array_r($_SESSION['userUuid'], $tableArray))) : ?>
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
          <button class="action">Claim Job</button>
        </center>
        </section>
    <?php endif; ?>
<script src="assets/js/index.js"></script>
</body>
<?php endif; ?>

</html>
