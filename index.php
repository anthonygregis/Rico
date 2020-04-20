<?php

require_once 'assets/php/sessionManage.php';
//require_once 'assets/php/darkTracker.php';
require_once 'assets/php/resolveUrl.php';
require_once 'assets/php/time_elapsed.php';

?>
<html>
<head>
  <meta charset="UTF-8">
  <title>RI₵O</title>
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Droid+Sans'>
  <script src="https://kit.fontawesome.com/7d71860d85.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="assets/css/main.css">
  <script src="assets/js/index.js"></script>
</head>

<!-- JOB BOARD -->
<?php if($loggedin) : ?>
<?php if(empty($_GET) && ($loggedin)) : ?>
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
          <p><strong style="color:white;"><?php echo $row['paymentAmount'] . " " . $row['paymentType']; ?></strong> - <?php echo time_elapsed_string($row['crimeTime']) ?></p>
        </div>
        </a>
      </div>
  <?php } ?>
  </div>
</body>
<?php endif; ?>

<!-- JOB DETAILS (USER) -->

<?php if((isset($job) || isset($claimJob) || isset($completeJob)) && ($sellerUuid !== $_SESSION['userUuid'])) : ?>
<body>
  <div class="header">
    <div class="glitch" data-text="RI₵O">RI₵O</div>
    <input type="button" value="Return" onclick="location.href='<?php echo $_SERVER[PHP_SELF]; ?>';">
  </div>
      <section class="jobDetails">
        <h1 class="center"><?php echo $crime ?></h1>
        <h4 class="center">Posted: <?php echo time_elapsed_string($crimeTime) ?></h4> 
        <?php if(isset($crimeUrl)) { echo '<center><img width="25%" src="' . $crimeUrl . '"><br>'; }?>
        <p>Job UUID: <?php echo $crimeUuid ?></p> 
        <p class="description">Job Description: <?php echo $crimeDescription ?></p> 
        </center>
        <p class="inline">Worker Limit: <?php echo $crimeLimit ?></p>
        <p class="inline-spaced">Current Claims: <?php echo $crimeClaims ?></p> 
        <p class="inline-spaced">Payment Type: <?php echo $paymentType ?></p> 
        <p class="inline-last">Payment Amount: <?php echo $paymentAmount ?></p>
        <hr style="border-color: inherit;">
        <br><br>
        <h4 class="center">Worker Actions</h4>
        <center>
        <!-- USER CLAIM JOB -->
         <?php if(($crimeClaims < $crimeLimit || $crimeLimit == -1) && (!in_array_r($_SESSION['userUuid'], $tableArray))) : ?>
            <button class="action" onclick="location.href='?claimJob=<?php echo $crimeUuid ?>';">Claim Job</button>
         <?php endif; ?>

        <!-- USER CONFIRM FINISHED -->
         <?php if((in_array_r($_SESSION['userUuid'], $tableArray)) && (!$crimeCompleted)) : ?>
          <form action="assets/php/jobComplete.php" method="POST">
            <input id="crimeUuid" name="crimeUuid" type="hidden" value="<?php echo $crimeUuid ?>">
            <input id="workerUuid" name="workerUuid" type="hidden" value="<?php echo $_SESSION['userUuid']; ?>">
            <input type="number" name="workerPaypal" placeholder="Paypal.."><br>
            <input type="text" name="crimeProof" placeholder="Proof... (MUST END IN JPG OR PNG)">
            <br>
            <input type="submit" value="Mark Complete">
          </form>
         <?php endif; ?>
         <?php if((in_array_r($_SESSION['userUuid'], $tableArray)) && ($crimeCompleted)) : ?>
          <h4>-- Awaiting Seller Verification --</h4>
         <?php endif; ?>
         
        </center>
      </section>
      <section class="chat">
        <center><h2>Communications Chat</h2></center>
        <iframe width="100%" height="100%" src="https://nopixel.online/darkweb/chat"></iframe>
      </section>
</body>
<?php endif; ?>

<!-- JOB DETAILS (SELLER) -->

<?php if((isset($job) || isset($claimJob)) && ($sellerUuid == $_SESSION['userUuid']) && (!isset($award))) : ?>
<body>
  <div class="header">
    <div class="glitch" data-text="RI₵O">RI₵O</div>
    <input type="button" value="Return" onclick="location.href='<?php echo $_SERVER[PHP_SELF]; ?>';">
  </div>
      <section class="jobDetails">
        <h1 class="center"><?php echo $crime ?></h1>
        <h4 class="center">Posted: <?php echo time_elapsed_string($crimeTime) ?></h4> 
        <?php if(isset($crimeUrl)) { echo '<center><img width="25%" src="' . $crimeUrl . '"><br>'; }?>
        <p>Job UUID: <?php echo $crimeUuid ?></p> 
        <p class="description">Job Description: <?php echo $crimeDescription ?></p> 
        </center>
        <p class="inline"><i class="fas fa-user" style="color: red;"></i> Limit: <?php if($crimeLimit > 0) { echo $crimeLimit; } elseif ($crimeLimit < 0) { echo "Unlimited"; } ?></p>
        <p class="inline-spaced"><i class="fas fa-user" style="color: red;"></i> Claims: <?php echo $crimeClaims ?></p> 
        <p class="inline-spaced"><i class="fas fa-money-bill-wave-alt"></i> Type: <?php echo $paymentType ?></p> 
        <p class="inline-last"><i class="fas fa-money-bill-wave-alt"></i> Amount: <?php echo $paymentAmount ?></p>
        <br>
        <hr style="border-color: inherit;">
        <h4 class="center">Current Claims</h4>
        <?php $i = 1; foreach($tableArray as $row) {?>
          <p>Worker UUID: <?php echo $row['workerUuid'] ?></p>
          <p>Worker Identifier: <?php echo $row['workerIdentifier'] ?>
          <p>Claimed At: <?php echo time_elapsed_string($row['claimTime']) ?></p>
          <p>Worker Proof: </p><img src="<?php echo $row['crimeProof'] ?>">
          <p><button class="action" onclick="location.href='?job=<?php echo $crimeUuid; ?>&awardWorker=<?php echo $row['workerUuid'] ?>';">Award Claim</button>
             <button class="action" onclick="location.href='?job=<?php echo $crimeUuid; ?>&reportWorker=<?php echo $row['workerUuid'] ?>';">Report Worker</button></p>
        <?php } ?>
      </section>
      <section class="chat">
        <center><h2>Communications Chat</h2></center>
        <iframe width="100%" height="40%" src="https://nopixel.online/darkweb/chat"></iframe>
      </section>
</body>
<?php endif; ?>

<!-- AWARD WORKER -->
<?php if(isset($award)) : ?>
<body>
  <div class="header">
    <div class="glitch" data-text="RI₵O">RI₵O</div>
    <input type="button" value="Return" onclick="location.href='<?php echo $_SERVER[PHP_SELF]; ?>';">
  </div>
  <section class="jobDetails">
    <h1 class="center">Worker Information Below</h1>
    <h4 class="center">Make contact via chat and delivery payment as discussed</h4> 
    <?php $i = 1; foreach($tableArray as $row) { ?>
      <?php if($row['workerUuid'] == $_GET['awardWorker']) : ?>
        <p>Worker UUID: <?php echo $row['workerUuid'] ?></p>
        <p>Worker Identifier: <?php echo $row['workerIdentifier'] ?></p>
        <p>Worker Paypal: <?php echo $row['workerPaypal'] ?></p>
        <p>Worker Proof: </p><img src="<?php echo $row['crimeProof'] ?>">
        <center><button class="action" onclick="location.href='?closeJob=<?php echo $row['crimeUuid'] ?>';">Close Job</button></center>
      <?php endif; ?>
    <?php } ?>
  </section>
  <section class="chat">
    <center><h2>Communications Chat</h2></center>
    <iframe width="100%" height="40%" src="https://nopixel.online/darkweb/chat"></iframe>
  </section>
</body>
<?php endif; ?>

<!-- CREATE JOB -->

<?php if(isset($create)) : ?>
<body>
  <div class="header">
    <div class="glitch" data-text="RI₵O">RI₵O</div>
    <input type="button" value="Return" onclick="location.href='<?php echo $_SERVER[PHP_SELF]; ?>';">
  </div>
      <section class="jobCreate">
        <h1 class="center">Post a Job</h1>
        <h4 class="center">Current Reputation: <?php echo $sellerRep; ?></h4> 
        <form action="assets/php/jobPost.php" method="POST">
          <input type="text" name="crime" placeholder="Job Name">
          <input id="sellerUuid" name="sellerUuid" type="hidden" value="<?php echo $_SESSION['userUuid']; ?>">
          <input type="number" name="workerLimit" placeholder="Active Contract Limits">
          <textarea name="crimeDescription" placeholder="Job Description" rows="4" cols="50"></textarea>
          <input type="url" name="crimeUrl" placeholder="Job Image (Optional) || URL MUST END IN .png or .jpg">
          <input type="text" name="paymentType" placeholder="Payment Type (Rolls, Bands, Paypal, Pixerium)">
          <input type="text" name="paymentAmount" placeholder="Payment Amount">
          <input type="submit" value="Submit">
        </form>
      </section>
</body>
<?php endif; ?>
<?php endif; ?>
</html>
