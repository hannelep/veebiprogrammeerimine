<?php
//kui failis ainult php, pole vaja php lõpu

function storeMessage($myMessage){
	$notice = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("INSERT INTO vpmsg1 (userid, message) VALUES(?,?)");
	echo $conn->error;
	$stmt -> bind_param("is", $_SESSION["userId"], $myMessage);
	if($stmt->execute()){
		$notice = "Sõnum salvestati!";
	} else {
		$notice = "Sõnumi salvestamisel tekkis tõrge: " .$stmt->error;
	}	
	$stmt -> close();
	$conn -> close();
	return $notice;
}

/*function readAllMessages() {
	$messagesHTML = "";
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	//$stmt = $conn -> prepare("SELECT message, created FROM vpmsg1");
	$stmt = $conn -> prepare("SELECT message, created FROM vpmsg1 WHRER deleted IS NULL");
	echo $conn -> error;
	$stmt -> bind_result($messagesFromDb, $createdFromDb);
	$stmt -> execute();
	while($stmt -> fetch()){
		$messagesHTML .= "<li>" .$messagesFromDb ." Lisatud: " .$createdFromDb ."</li> \n";
	}
	if(!empty($messagesHTML)){
		$messagesHTML = "<ul> \n" .$messagesHTML ."</ul> \n";
	} else {
		$messagesHTML = "<p> Sõnumeid ei ole! </p> \n";
	}
	
	$stmt -> close();
	$conn -> close();
	return $messagesHTML;
}	*/

function readMyMessages() {
	$messagesHTML = "";
	$limit = 7;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	//$stmt = $conn -> prepare("SELECT message, created FROM vpmsg1");
	//$stmt = $conn -> prepare("SELECT message, created FROM vpmsg1 WHRER deleted IS NULL");
	$stmt = $conn -> prepare("SELECT message, created FROM vpmsg1 WHERE userid = ? AND deleted IS NULL ORDER BY created DESC LIMIT ?");
	echo $conn -> error;
	$stmt -> bind_param("ii", $_SESSION["userId"], $limit);
	$stmt -> bind_result($messagesFromDb, $createdFromDb);
	$stmt -> execute();
	while($stmt -> fetch()){
		$messagesHTML .= "<li>" .$messagesFromDb ." Lisatud: " .$createdFromDb ."</li> \n";
	}
	if(!empty($messagesHTML)){
		$messagesHTML = "<ul> \n" .$messagesHTML ."</ul> \n";
	} else {
		$messagesHTML = "<p> Sõnumeid ei ole! </p> \n";
	}
	
	$stmt -> close();
	$conn -> close();
	return $messagesHTML;
}	

//Lisa profiili juurde parooli muutmine, küsi senist parooli, sisesta kaks korda uut parooli ja kas oli sama parool ja kas oli piisavalt pikk