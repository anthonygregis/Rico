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
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>RICO</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<section id=timeline>
	<h1>A Flexbox Timeline</h1>
	<p class="leader">All cards must be the same height and width for space calculations on large screens.</p>
	<div class="demo-card-wrapper">
	<?php $i = 1; foreach($tableArray as $row) {?>
		<div class="demo-card demo-card--step<?php echo $row['counter'] + 1 ?>">
			<div class="head">
				<div class="number-box">
					<span><?php echo $row['counter'] + 1 ?></span>
				</div>
				<h2><span class="small"><?php echo time_elapsed_string($row['crimeTime']) ?></span> <?php echo $row['crime'] ?></h2>
			</div>
			<div class="body">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta reiciendis deserunt doloribus consequatur, laudantium odio dolorum laboriosam.</p>
				<img src="http://placehold.it/1000x500" alt="Graphic">
			</div>
		</div>
	<?php } ?>
	</div>
</section>
<!-- partial -->
  
</body>
</html>
