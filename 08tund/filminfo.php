<?php
  require("../../../config_vp2019.php");
  require("functions_film.php");
  //echo $serverHost;
  require("functions_main.php");  
  require("functions_user.php");
  $database = "if19_hannele_pr_1";
  
  $filmInfoHTML = readAllFilms();
  $someFilmInfoHTML = readSomeFilms();
  
  if(!isset($_SESSION["userId"])) {
	  //siis jõuga sisselogimise lehele
	  header("Location: page.php");
	  exit();
  }
  
  //väljalogimie
  if(isset($_GET["Logout"])){
	  session_destroy();
	  header("Location: page.php");
	  exit();
  }
  
  $userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
  $userid = $_SESSION["userID"];
  
  
  require("header.php");
  
  ?>
  <h2 style="color:red">Oluline!</h2>
  <p title="Tõesti väga oluline"> See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <hr>
  
  <h2>Eesti filmid</h2>
  <p>Praegu meie andmebaasis on järgmised filmid:</p>
  <?php
    
	echo $filmInfoHTML;
  ?>
  <hr>
  
  <h2>Filmid, mis on vanemad kui 50 aastat: </h2>
  <?php
  
	echo $someFilmInfoHTML;
  ?>
</body>
</html>