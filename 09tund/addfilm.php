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
  $filmTitle = null;
  $filmYear = null;
  $filmDuration = null;
  $filmDescription = null;
  $filmTitleError = null;
  $filmYearError = null;
  $filmDurationError = null;
  $filmDescriptionError = null;
  
  if(isset($_POST["submitFilm"])){
	  if(isset($_POST["filmTitle"]) and !empty($_POST["filmTitle"])){
		$filmTitle = test_input($_POST["filmTitle"]);
	  } else {
		$filmTitleError = "Palun sisesta filmi pealkiri!";
	  }
	  if (null !== $filmYear) {
		$filmYear = intval($_POST["filmYear"]);
	  } else {
		$filmYearError = "Paluna sisesta filmi ilmumis aasta!";
	  }
	  if (null !== $filmDuration){
		$filmDuration = intval($_POST["filmDuration"]);
	  } else {
		$filmDurationError = "Palun sisesta filmi pikkus!";
	  }
	  if(isset($_POST["filmDescription"]) and !empty($_POST["filmDescription"])){
		$filmDescription = test_input($_POST["filmDescription"]);
	  } else {
		$filmDescriptionError = "Palun sisesta filmi sisukokkuvõte";
	  }
	}
  require ("header.php");
 
  
  ?>
  <?php
    echo "<h1>" .$userName .", siin saad lisada filmi infot!</h1>";
  ?>

   <p>Lisa film!</p>
   <hr>
   <p><a href="?logout=1">Logi välja!</a> | Tagasi <a href="home.php">avalehele</a></p>
   <br>
   <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Filmi pealkiri:</label><br>
	  <input type="text" value="<?php echo $filmTitle; ?>" name="filmTitle"><span><?php echo $filmTitleError; ?></span><br>
	  <br>
	  <label>Filmi tootmisaasta:</label><br>
	  <input type="number" min="1912" max="2019" value="<?php echo $filmYear; ?>" name="filmYear"><span><?php echo $filmYearError; ?></span><br>
	  <br>
	  <label>Filmi kestus (min): </label>
	  <input type="number" min="1" max="300" value="<?php echo $filmDuration; ?>" name="filmDuration"><span><?php echo $filmDurationError; ?></span><br>
	  <br>
	  <label>Filmi sisukokkuvõte:</label><br>
	  <textarea rows="10" cols="80" name="filmDescription" placeholder="Lisa siia filmi sisukokkuvõte..."><?php echo $filmDescription; ?></textarea><span><?php echo $filmDescriptionError; ?></span><br>
	  <br>
	  <input type="submit" value="Talleta filmi info" name="submitFilm"><span><?php echo $notice; ?></span>
    </form>
  
</body>
</html>