<?php
  $userName = "Hannele Pruunlep";
	
  $fullTimeNow = date("d.m.Y. H:i:s");
  $hourNow = date("H");

  $weekDaysET = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
  $weekDayNow = date("N");
  $monthsET = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", " august", "september", "oktoober", "november", "detsember"];
  $monthNow = date("n");
  $day_now = $weekDaysET[$weekDayNow - 1];
  $month_now = $monthsET[$monthNow - 1];
?>
<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8">
  <title>
  <?php
  echo $userName;
  ?>
   programmeerib veebi</title>
   
 
  
</head>
<body>