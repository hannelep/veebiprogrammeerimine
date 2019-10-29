<?php
 function singUp($name, $surname, $email, $gender, $birthDate, $password){
	$notice = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("INSERT INTO vpusers (firstname, lastname, birthdate, gender, email, password) VALUES(?,?,?,?,?,?)");
	echo $conn->error;
	$options = ["cost" => 12, "salt" => substr(sha1(rand()), 0, 22)];
	$pwdhash = password_hash($password, PASSWORD_BCRYPT, $options);
	$stmt->bind_param("sssiss", $name, $surname, $birthDate, $gender, $email, $pwdhash);
	if($stmt->execute()){
		$notice = "Kasutaja andmete loomine õnnestus!";
	} else {
		$notice = "Kasutaja loomisel tekkis tehniline viga: " .$stmt->error;
	}
	
	$stmt -> close();
	$conn -> close();
	return $notice;
	
	
 function singIn($email, $password) {
	$notice = null;
	$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT id, firstname, lastname, password FROM vpusers1 WHERE email=?");
	$conn->error;
	$stmt->bind_param("s", $email);
	$stmt->bind_result($idFromDb, $firstnameFromDb, $lastnameFromDb, $passwordFromDb);
	if($stmt->execute()){
		//kui andmebaasist lugemine õnnestus
		if($stmt->fetch()){
			//leiti selline kasutaja
			if(password_verify($password, $passwordFromDb)){
				//parool õige
				$notice = "Logisite õnnelikult sisse!";
				$_SESSION["userId"] = $idFromDb;
				$_SESSION["firstName"] = $firstnameFromDb;
				$_SESSION["lastName"] = $lastnameFromDb;
				$stmt->close();
				$mysqli->close();
				header("location: page.php");
				exit();
			} else {
				$notice = "Sisestasite vale salasõna!";
			}
		} else {
			$notice = "Sellist kasutajat (" .$email .") ei leitud!";  
		}
	} else {
		$notice = "Sisselogimisel tekkis tehniline viga!" .$stmt->error;
	}
	$stmt->close();
	$mysqli->close();
	return $notice;
 }
			
 }