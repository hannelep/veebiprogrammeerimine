<?php
  function storeFilmInfo($filmTitle, $filmYear, $filmDuration, $filmDescription){
	  $notice = null;
	  $conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	  $stmt = $conn -> prepare("INSERT INTO FILM (pealkiri, aasta, kestus, sisukokkuvote) VALUES(?,?,?,?)");
	  echo $conn -> error;
	  //andmetüübid: s - string   i - integer   d - decimal
	  $stmt -> bind_param("siis", $filmTitle, $filmYear, $filmDuration, $filmDescription);
	  if($stmt -> execute()){
		  $notice = "Filmi lisamine õnnestus!";
	  } else {
		  $notice = "Filmi lisamine ebaõnnestus!" .$stmt->error;
	  }
	  
	  
	  $stmt -> close();
	  $conn -> close();
	  return $notice
  }
?>