<?php
  require("../../../config_vp2019.php");
  require("functions_user.php");
  require("functions_main.php");
  $database = "if19_hannele_pr_1";
  
  
  //kontrollime, kas on sisse logitud
  if(!isset($_SESSION["userId"])){
	  header("Location: page.php");
	  exit();
  }
  if(isset($_GET["logout"])){
	  session_destroy();  
	  header("Location: page.php");
	  exit();
  }
  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
  
  $notice = null;
  $myDescription = null;
  $oldpasswordError = null;
  $newpasswordError = null;
  $newpasswordError2 = null;
  
  
  if(isset($_POST["submitProfile"])){
	$notice = storeProfile($_POST["description"], $_POST["bgcolor"], $_POST["txtcolor"]);
	if(!empty($_POST["description"])){
	  $myDescription = $_POST["description"];
	}
	$_SESSION["bgColor"] = $_POST["bgcolor"];
	$_SESSION["txtColor"] = $_POST["txtcolor"];
} else {
	$myProfileDesc = showMyDesc();
	if($myProfileDesc != ""){
	  $myDescription = $myProfileDesc;
    }
  }
  
  if(isset($_POST["changePassword"])) {
	if(isset($_POST["oldpassword"]) and !empty($_POST["oldpassword"])) {
		if(($_POST["oldpassword"]) == ($_POST["newpassword"])) {
			$oldpasswordError = "Uus salasõna ei saa olla sama, mis on vana salasõna!";
		} else {
		$oldpassword = test_input($_POST["oldpassword"]);
		}
	} else {
		$oldpasswordError = "Sisestage praegune salasõna!";
	}
	if(isset($_POST["newpassword"]) and !empty($_POST["newpassword"])){
		$newpassword = test_input($_POST["newpassword"]);
		if (strlen($_POST["newpassword"]) > 7 ){
			$newpassword = ($_POST["newpassword"]);
		} else { 
			$newpasswordError = "Parool pole piisavalt pikk";
		}
	} else {
		$newpasswordError = "Palun sisestage uus parool!";
	}
	if (!isset($_POST["newpassword2"]) or empty($_POST["newpassword2"])){
		$confirmpasswordError = "Palun sisestage uus salasõna teist korda!";  
	} else {
		if($_POST["newpassword"] != $_POST["newpassword2"]){
			$confirmpasswordError = "Sisestatud salasõnad ei olnud ühesugused!";
		}
	}
	if (empty($oldpasswordError) and empty($newpasswordError) and empty($newpasswordError2)) {
		$notice = changePassword($_SESSION["userId"], $_POST["oldpassword"], $_POST["newpassword"]);
	} else {
		$notice = "Salasõna vahetamine ei õnnestunud!";
	}
  }
   

  require ("header.php");
 
  
  ?>
  <?php
    echo "<h1>" .$userName .", siin saad oma profiili muuta</h1>";
  ?>

  <p>Muuda oma profiili!</p>
  <hr>
  <p><a href="?logout=1">Logi välja!</a> | Tagasi <a href="home.php">avalehele</a></p>
  <br>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Minu kirjeldus</label><br>
	  <textarea rows="10" cols="80" name="description" placeholder="Lisa siia oma tutvustus..."><?php echo $myDescription; ?></textarea>
	  <br>
	  <label>Minu valitud taustavärv: </label><input name="bgcolor" type="color" value="<?php echo $_SESSION["bgColor"]; ?>"><br>
	  <label>Minu valitud tekstivärv: </label><input name="txtcolor" type="color" value="<?php echo $_SESSION["txtColor"]; ?>"><br>
	  <input name="submitProfile" type="submit" value="Salvesta profiil"><span><?php echo $notice; ?></span>
   </form>
   <br>
   <p>Muuda oma parooli!</p>
   <br>
   <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Vana salasõna:</label><br>
	  <input name="oldpassword" type="password"><span><?php echo $oldpasswordError; ?></span><br>
	  <label>Uus salasõna (min 8 tähemärki):</label><br>
	  <input name="newpassword" type="password"><span><?php echo $newpasswordError; ?></span><br>
	  <label>Korrake uut salasõna:</label><br>
	  <input name="newpassword2" type="password"><span><?php echo $newpasswordError2; ?></span><br>
	  <input name="changePassword" type="submit" value="Muuda parooli"><span><?php echo $notice; ?></span>
    </form>
  
</body>
</html>