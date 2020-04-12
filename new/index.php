<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>RI₵O</title>
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Droid+Sans'>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="assets/css/main.css">
</head>

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
    <div class="title"><?php echo $row['crime'] ?></div>
    <div class="body big">
      <p><?php echo time_elapsed_string($row['crimeTime']) ?></strong></p>
    </div>
  </div>
  <?php } ?>
</div>
  
<script src="js/index.js"></script>
</body>
</html>
