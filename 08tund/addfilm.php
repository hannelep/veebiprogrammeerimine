<?php
  require("../../../config_vp2019.php");
  require("functions_film.php");
  //echo $serverHost;
  $userName = "Hannele Pruunlep";
  $database = "if19_hannele_pr_1";
  
  $filmTitle = null;
  $filmYear = date("Y");
  $filmDuration = 80;
  $filmGenre = null;
  $filmStudio = null;
  $filmDirector = null;
  
  $notice = null;
  
  //var_dump($_POST);
  //kui on nuppu vajutatud
   if(isset($_POST["submitFilm"])){
	  $filmTitle = $_POST["filmTitle"];
	  $filmYear = $_POST["filmYear"];
	  $filmDuration = $_POST["filmDuration"];
	  $filmGenre = $_POST["filmGenre"];
	  $filmStudio = $_POST["filmStudio"];
	  $filmDirector = $_POST["filmDirector"];
		//salvestame, kui vähemalt pealkiri on olemas
		if(!empty($_POST["filmTitle"])){
		  saveFilmInfo($filmTitle, $filmYear, $filmDuration, $filmGenre, $filmStudio, $filmDirector);
		  $filmTitle = null;
		  $filmYear = date("Y");
		  $filmDuration = 80;
		  $filmGenre = null;
		  $filmStudio = null;
		  $filmDirector = null;
		} else {
		   $notice = "Palun sisestage vähemalt filmi pealkiri!";
		}
	}
   
  //$filmInfoHTML = readAllFilms();
  
  require("header.php");
  echo "<h1>" .$userName .", veebiprogrammeerimine</h1>";
  ?>
  <body>
  <h2 style="color:red">Oluline!</h2>
  <p title="Tõesti väga oluline"> See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <hr>
  
  <h2>Eesti filmid</h2>
  <p>Lisa uus film andmebaasi</p>
  <hr>
  <form method="POST">
    <label>Kirjuta filmi pealkiri: </label>
	<input type="text" value="<?php echo $filmTitle; ?>" "name="filmTitle">
	<br>
	<label>Filmi tootmisaasta: </label>
	<input type="number" min="1912" max="2019" value="<?php echo $filmYear; ?>" name="filmYear">
	<br>
	<label>Filmi kestus (min): </label>
	<input type="number" min="1" max="300" value="<?php echo $filmDuration; ?>" name="filmDuration">
	<br>
	<label>Filmi žanr: </label>
	<input type="text" value="<?php echo $filmGenre; ?>" name="filmGenre">
	<br>
	<label> Filmi tootja: </label>
	<input type="text" value="<?php echo $filmStudio; ?>" name="filmStudio">
	<br>
	<label> Filmi lavastaja: </label>
	<input type="text" value="<?php echo $filmDirector; ?>" name="filmDirector">
	<br>
	<input type="submit" value="Talleta filmi info" name="submitFilm">
	
  </form>
  <?php
    echo "<p>" .$notice ."</p>";
  ?>
  
</body>
</html>