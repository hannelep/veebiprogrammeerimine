<?php
  $userName = "Hannele Pruunlep";
  $fullTimeNow = date("d.m.Y. H:i:s");
  $hourNow = date("H");
  $partOfDay = "hägune aeg";
  
  if($hourNow < 11) {
	$partOfDay = "hommik";
  }
  if($hourNow > 18) {
	$partOfDay = "õhtu";
  }
  if($hourNow < 6) {
	$partOfDay = "öö";
  }
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
  <?php
  echo "<h1>" .$userName .", veebiprogrammeerimine</h1>";
  ?>
  <h2 style="color:red">Oluline!</h2>
  <p title="Tõesti väga oluline"> See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <hr>
  <?php
    echo "<p>lehe avamise hetkel oli aeg: " .$fullTimeNow .", " .$partOfDay .".</p>";
  ?>
  <hr>
  <h2 style="color:purple">Minu tunnid teisipäeval on:</h2>
  <ul>
    <li>Veebiprogrammeerimine</li>
	<li>Andmebaaside projekteerimine</li>
	<li>Operatsioonisüsteemide alused ja haldamine</li>
  

</body>
</html>