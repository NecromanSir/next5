<!DOCTYPE html>
<html>
<head>
    <title>Race View</title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<link rel="stylesheet" href="../css/styles.css" type="text/css" />
</head>

<body>
<div id="topHeader">
	<p>Current Time: <span id="dateTimeDisplay"></span></p>
</div>
<div id="raceTable">
<?php
$raceTarget = $_GET["raceID"];
$csv = array_map('str_getcsv', file("../src/races2.csv"));
array_walk($csv, function(&$a) use ($csv) {
    $a = array_combine($csv[0], $a);
});
    array_shift($csv);
    ?>
   <?php if (count($csv) > 0): ?>
<table>
  <thead>
    <tr>
      <th>Competitor Name</th><th>Position</th>
    </tr>
  </thead>
  <tbody>
<?php 
    $rowcount = 0;
    foreach ($csv as $row): array_map('htmlentities', $row); $raceId=$row['id'];

      if ($raceTarget != $raceId) {
            continue;
      }
      ?>
      <?php
      $competitorvar = $row['competitors'];
      $competitorList = explode(".", $competitorvar);
      foreach($competitorList as $comp):
      ?>
      <tr>
      <td>
      <?php 
          $compRow = explode(" ", $comp);
          echo implode('</td><td>', $compRow); ?></td>
      </tr>
      <?php endforeach;?>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
</br>
<a href="./index.php"><< Back</a>
</div>
</body>
<footer>
<script type="text/javascript" src="../js/scripts.js"></script>
</footer>
<?php endif; ?>
</html>