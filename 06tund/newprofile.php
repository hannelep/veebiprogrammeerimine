<?php
  require("../../../config_vp2019.php");
  require("functions_user.php");
  $database = "if19_hannele_pr_1";
  
  $notice = "";
  $idFromDb = "";
  $mydescription = "";
  $mybgcolor = "";
  $mytxtcolor = "";
  
  
  //kontrollime, kas on sisse logitud
  if(!isset($_SESSION["userId"])){
	  header("Location: page.php");
	  exit();
  }	
  if(isset($_POST["submitProfile"])){
	  
  
  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
 
  require("header.php");
  echo "<h1>" .$userName .", siin saad oma profiili muuta</h1>";
  
  ?>
  <!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="utf-8">
	<title>Profiili loomine</title>
  </head>
  <body>
  <p>Muuda oma profiili!</p>
  <hr>
  <br>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Minu kirjeldus</label><br>
	  <textarea rows="10" cols="80" name="description"><?php echo $mydescription; ?></textarea>
	  <br>
	  <label>Minu valitud taustavärv: </label><input name="bgcolor" type="color" value="<?php echo $mybgcolor; ?>"><br>
	  <label>Minu valitud tekstivärv: </label><input name="txtcolor" type="color" value="<?php echo $mytxtcolor; ?>"><br>
	  <input name="submitProfile" type="submit" value="Salvesta profiil">
   </form>
  
</body>
</html>