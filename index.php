<?php
// Initialize the session
session_start();

if(isset($_GET["loggedin"])) {
  $loggedin = true;
}

if(isset($_GET["job"])) { 
  $job = $_GET["job"];
  require_once 'assets/php/jobDetail.php';
} else {
  require_once 'assets/php/jobs.php';
}

if(isset($_GET["sort"])) { 
    $sort = $_GET["sort"];
}

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
        <div class="title big <?php if($row['sponsoredJob'] == 1) { echo "talon"; } ?>"><?php if($row['sponsoredJob'] == 1) : ?><img class="image-talon" width="15%" src="assets/img/talon.png"/><?php endif; ?><?php echo $row['crime'] ?></div>
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
  <section class="intro">
        <p>Rico is designed to allow discreet contracts to be carried out between employers and workers. Designed to protect both parties and achieve maximum effeciency.
        Employing a reputation system for both parties to ensure that you are rewarded for providing / completing contracts effectively.</p> 
      <br>
  </section>
<script src="assets/js/index.js"></script>
</body>
<?php endif; ?>
</html>
