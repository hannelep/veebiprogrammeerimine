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

  require ("header.php");
 
  
  ?>
  <?php
    echo "<h1>" .$userName .", siin saad parooli muuta!</h1>";
  ?>

  <p>Muuda oma profiili!</p>
  <hr>
  <p><a href="?logout=1">Logi välja!</a> | Tagasi <a href="home.php">avalehele</a></p>
  <br>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Salasõna (min 8 tähemärki):</label><br>
	  <input name="password" type="password"><span><?php echo $passwordError; ?></span><br>
	  <label>Korrake salasõna:</label><br>
	  <input name="confirmpassword" type="password"><span><?php echo $confirmpasswordError; ?></span><br>
	  <input name="" type="submit" value="Loo kasutaja"><span><?php echo $notice; ?></span>
   </form>
  
</body>
</html>