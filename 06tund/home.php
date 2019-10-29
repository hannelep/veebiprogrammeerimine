<?php
  require("../../../config_vp2019.php");
  require("functions_user.php");
  $database = "if19_hannele_pr_1";
  
  //kontrollime, kas on sisse logitud
  if(!isset($_SESSION["userId"])){
	  header("Location: page.php");
	  exit();
  }	
  
  //logime välja
  if(isset($_GET["logout"])){
	  session_destroy();  
	  header("Location: page.php");
	  exit();
  }
  
  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];

  
  ?>
  <!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="utf-8">
	<title>Koduleht</title>
  </head>
  <body>
  <p> See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <hr>
  <p>Kujunda oma profiili <a href="newprofile.php">siin</a></p>
  <br>
  <p><?php echo $userName; ?>  | Logi <a href="?logout=1">välja!</a></p>
  
</body>
</html>