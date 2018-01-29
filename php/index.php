<!DOCTYPE html>
<html>
<head>
    <title>Next 5 Races</title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<link rel="stylesheet" href="../css/styles.css" type="text/css" />
</head>
<body>
<div id="topHeader">
	<p>Current Time: <span id="dateTimeDisplay"></span></p>
</div>
<div id="raceTable">
<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); 
header("Pragma: no-cache"); 
header("Expires: 0");
$csv = array_map('str_getcsv', file("../src/races.csv"));
array_walk($csv, function(&$a) use ($csv) {
    $a = array_combine($csv[0], $a);
});
    array_shift($csv);
    function date_compare($a, $b)
    {
        $t1 = strtotime($a['time']);
        $t2 = strtotime($b['time']);
        return $t1 - $t2;
    }
    usort($csv, 'date_compare');
    ?>
   <?php if (count($csv) > 0): ?>
<table>
  <thead>
    <tr>
      <th><?php echo implode('</th><th>', array_keys(current($csv))); ?></th>
      <th>time left</th>
    </tr>
  </thead>
  <tbody>
<?php 
    $datetime2 = date('d-m-Y h:i:s a', time());
    $datetime2 = date_create_from_format('d-m-Y h:i:s a', $datetime2);
    $datestr2 = strtotime($datetime2->format('d-m-Y h:i:s a'));
    $rowcount = 0;
    foreach ($csv as $row): array_map('htmlentities', $row); $time=$row['time'];
    $datetime1 = date_create_from_format('d-m-Y h:i:s a', $time);
    date_default_timezone_set('Australia/Brisbane');
    $datestr1 = strtotime($datetime1->format('d-m-Y h:i:s a'));
    $dateDiff = $datestr1 - $datestr2;
    if ($dateDiff < 0) {
        unset($csv[$row]);
        continue;
    } else if ($rowcount >= 5) {
        continue;
    } else {
        $rowcount++;
    }
    $link = "http://mitech2.wpengine.com/next5/php/getRace.php?raceID=" . $row['id'];  ?>
    <tr class="clickable-row" data-href=<?php echo $link; ?>>
      <td><?php echo implode('</td><td>', $row); ?></td>
      <td class="durationField"><?php 

      echo $dateDiff;
      ?></td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
</div>
</body>
<footer>
<script type="text/javascript" src="../js/scripts.js"></script>
</footer>
<?php endif; ?>
</html>