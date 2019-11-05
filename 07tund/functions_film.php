<?php
  function readAllFilms(){
	  //var_dump($GLOBALS);
	  //loeme andmebaasist filmide infot
	  //loome andmebaasiühenduse ($mysqli  $conn)
	  //$conn = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
	  $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	  mysqli_set_charset( $conn, 'utf8');
	  //valmistan ette päringu
	  $stmt = $conn -> prepare("SELECT pealkiri, zanr, lavastaja, kestus, tootja, aasta FROM film");
	  //echo $conn -> error;
	  $filmInfoHTML = null;
	  $stmt -> bind_result($filmTitle, $filmGenre, $filmDirector, $filmDuration, $filmStudio, $filmYear);
	  $stmt -> execute();
	  //sain pinu (stack) täie infot, hakkan ühe kaupa võtma, kuni saab
	  while($stmt -> fetch()){
		//echo " Pealkiri: " .$filmTitle;
		$filmInfoHTML .= "<h3>" .$filmTitle ."</h3>";
		$filmInfoHTML .= "<p> Žanr: " .$filmGenre .", lavastaja: " .$filmDirector .".";
		if ($filmDuration < 60) {
			$filmInfoHTML .= " Kestus: " .$filmDuration ." minutit.";
		}elseif (round($filmDuration/60) < 2) {
			$filmInfoHTML .= " Kestus: " .round($filmDuration/60) ." tund";
			if ($filmDuration%60 > 1) {
				$filmInfoHTML .= " ja " .round($filmDuration%60) ." minutit.";
			}elseif ($filmDuration%60 != 0 and $filmDuration%60 < 2) {
				$filmInfoHTML .= " ja " .round($filmDuration%60) ." minut.";
			}else{
				$filmInfoHTML .= ".";
			}
		}else{
			$filmInfoHTML .= " Kestus: " .round($filmDuration/60) ." tundi";
			if ($filmDuration%60 > 1) {
				$filmInfoHTML .= " ja " .round($filmDuration%60) ." minutit.";
			}elseif ($filmDuration%60 != 0 and $filmDuration%60 < 2) {
				$filmInfoHTML .= " ja " .round($filmDuration%60) ." minut.";
			}else{
				$filmInfoHTML .= ".";
			}
		}
		$filmInfoHTML .= " Tootnud: " .$filmStudio ." aastal: " .$filmYear ."</p>";
	  }
	  //sulgen ühenduse
	  $stmt -> close();
	  $conn -> close();
	  return $filmInfoHTML;
    }  
	  
  function readSomeFilms (){
	  $maxYear = date("Y") - 50;
	  $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	  mysqli_set_charset( $conn, 'utf8');
	  $stmt = $conn -> prepare("SELECT pealkiri, zanr, lavastaja, kestus, tootja, aasta FROM film WHERE aasta < ? ");
	  //echo $conn -> error;
	  $someFilmInfoHTML = null;
	  $stmt -> bind_result($filmTitle, $filmGenre, $filmDirector, $filmDuration, $filmStudio, $filmYear);
	  $stmt -> bind_param("i", $maxYear);
	  $stmt -> execute();
	  while($stmt -> fetch()){
		$someFilmInfoHTML .= "<h3>" .$filmTitle ."</h3>";
		$someFilmInfoHTML .= "<p> Žanr: " .$filmGenre .", lavastaja: " .$filmDirector .".";
		if ($filmDuration < 60) {
			$someFilmInfoHTML .= " Kestus: " .$filmDuration ." minutit.";
		}elseif (round($filmDuration/60) < 2) {
			$someFilmInfoHTML .= " Kestus: " .round($filmDuration/60) ." tund";
			if ($filmDuration%60 > 1) {
				$someFilmInfoHTML .= " ja " .round($filmDuration%60) ." minutit.";
			}elseif (filmDuration%60 != 0 and $filmDuration%60 < 2) {
				$someFilmInfoHTML .= " ja " .round($filmDuration%60) ." minut.";
			}else{
				$someFilmInfoHTML .= ".";
			}
		}else{
			$someFilmInfoHTML .= " Kestus: " .round($filmDuration/60) ." tundi";
			if ($filmDuration%60 > 1) {
				$someFilmInfoHTML .= " ja " .round($filmDuration%60) ." minutit.";
			}elseif ($filmDuration%60 != 0 and $filmDuration%60 < 2) {
				$someFilmInfoHTML .= " ja " .round($filmDuration%60) ." minut.";
			}else{
				$someFilmInfoHTML .= ".";
			}
		}
		$someFilmInfoHTML .= " Tootnud: " .$filmStudio ." aastal: " .$filmYear ."</p>";
	  }
	  //sulgen ühenduse
	  $stmt -> close();
	  $conn -> close();
	  return $someFilmInfoHTML;
  
    }
  function storeFilmInfo($filmTitle, $filmYear, $filmDuration, $filmGenre, $filmStudio, $filmDirector){
	  $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	  $stmt = $conn -> prepare("INSERT INTO FILM (pealkiri, aasta, kestus, sisukokkuvote) VALUES(?,?,?,?)");
	  echo $conn -> error;
	  //andmetüübid: s - string   i - integer   d - decimal
	  $stmt -> bind_param("siis", $filmTitle, $filmYear, $filmDuration, $filmDuration);
	  $stmt -> execute();
	  
	  $stmt -> close();
	  $conn -> close();
  }
?>