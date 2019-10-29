<?php
  require("../../../config_vp2019.php");
  require("functions_film.php");
  //echo $serverHost;
  $userName = "Hannele Pruunlep";
  $database = "if19_hannele_pr_1";
  
  $filmInfoHTML = readAllFilms();
  $someFilmInfoHTML = readSomeFilms();
  
  require("header.php");
  echo "<h1>" .$userName .", veebiprogrammeerimine</h1>";
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