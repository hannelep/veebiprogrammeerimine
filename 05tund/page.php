<?php
  $userName = "Hannele Pruunlep";
  
  $photoDir = "../photos/";
  $photoTypes = ["image/jpeg", "image/png"];
  
  $weekDaysET = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
  $monthsET = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", " august", "september", "oktoober", "november", "detsember"];
  $weekDayNow = date("N");
  $dateNow = date("d");
  $monthNow = date("n");
  $yearNow = date("Y");
  $timeNow = date("H:i:s");
  $fullTimeNow = date("d.m.Y. H:i:s");
  $hourNow = date("H");
  $partOfDay = "hägune aeg";
  
  
  if($hourNow < 11) {
	$partOfDay = "hommik";
		} 
		if($hourNow > 17) {
			$partOfDay = "õhtu";
		} 
		if($hourNow < 6) {
			$partOfDay = "öö";  
		}
	
	//info semestri kulgemise kohta
	$semesterStart =  new DateTime("2019-9-2");
	$semesterEnd = new DateTime("2019-12-13");
	$semesterDuration = $semesterStart -> diff($semesterEnd);
	$today = new DateTime("now");
	$semesterElapsed = $semesterStart -> diff($today);
	//echo $semesterDuration;
	//var_dump($semesterDuration);
	//<p>Semester on täies hoos:
    //<meter min="0" max="112" value="16">13%</meter>
	//</p>
	$semesterInfoHTML = null;
	if($semesterElapsed -> format ("%r%a") >= 0) {
	  $semesterInfoHTML = "<p> Semester on täies hoos:";
      $semesterInfoHTML .= '<meter min="0" max="' .$semesterDuration -> format ("%r%a") .'" ';
      $semesterInfoHTML .= 'value="' .$semesterElapsed -> format ("%r%a") .'" >';
      $semesterInfoHTML .= round($semesterElapsed -> format ("%r%a") / $semesterDuration -> format ("%r%a") * 100, 1) ."%";
	  $semesterInfoHTML .= "</meter> </p>";
    } if($semesterElapsed > $semesterDuration) {
		$semesterInfoHTML = "<p> Semester on läbi </p>";
	} if($semesterElapsed -> format ("%r%a") < 0) {
		$semesterInfoHTML = "<p> Semester pole veel alanud </p>";
	}
	//foto näitamine lehel
	$fileList = array_slice(scandir($photoDir), 2);
	//var_dump($fileList);
	$photoList = [];
	foreach ($fileList as $file){
		$fileInfo = getImagesize($photoDir .$file);
		//var_dump($fileInfo);
		if (in_array($fileInfo["mime"], $photoTypes)){
			array_push($photoList, $file);
		}
	}
	
	
	//$photoList = ["tlu_terra_600x400_1.jpg", "tlu_terra_600x400_2.jpg", "tlu_terra_600x400_3.jpg"];//array ehk massiiv
	//var_dump($photoList);
	$photoCount = count($photoList);
	//echo $photoCount;
	$photoNum = mt_rand(0, $photoCount - 1);
	//echo $photoList[$photoNum];
	// <img src="../photos/tlu_terra_600x400_1.jpg" alt="TLÜ Terra õppehoone"> 
	$randomImgHTML ='<img src="' .$photoDir .$photoList[$photoNum] . '" alt="Juhuslik foto">';

	require("header.php");
	
	echo "<h1>" .$userName .", veebiprogrammeerimine</h1>";
  ?>
  <h2 style="color:red">Oluline!</h2>
  <p title="Tõesti väga oluline"> See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <?php
    echo $semesterInfoHTML;
  ?>
  <hr>
  <?php
    //echo "<p> Lehe avamise hetkel oli aeg: " .$fullTimeNow .", " .$partOfDay . ". </p>";
	echo "<p> Lehe avamise hetkel oli aeg: " .$weekDaysET[$weekDayNow - 1] .", " .$dateNow .". " .$monthsET[$monthNow - 1] ." " .$yearNow ." kell " .$timeNow ."</p>";

	echo $randomImgHTML;
  ?>

  <hr>
  <h2 style="color:purple">Minu tunnid teisipäeval on:</h2>
  <ul>
    <li>Veebiprogrammeerimine</li>
	<li>Andmebaaside projekteerimine</li>
	<li>Operatsioonisüsteemide alused ja haldamine</li>
  

</body>
</html>