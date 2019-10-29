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
  
</body>
</html>