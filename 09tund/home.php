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
  
  //logime välja
  if(isset($_GET["logout"])){
	  session_destroy();  
	  header("Location: page.php");
	  exit();
  }
  
  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
  require("header.php");
  
  ?>

  <p> See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <hr>
  <br>
  <p><?php echo $userName; ?>  | Logi <a href="?logout=1">välja!</a></p>
  <br>
  <ul>
    <li><a href="newprofile.php">Kujunda oma profiili siin</a></li>
    <li><a href="messages.php">Sõnumid</a></li>
    <li><a href="newpassword.php">Vaheta parool</a></li>
    <li><a href="filminfo.php">Filmid</a></li>
	<li><a href="addfilm.php">Lisa filme</a></li>
    <li><a href="picupload.php">Piltide üleslaadimine</a></li>
  </ul>
</body>
</html>