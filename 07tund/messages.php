<?php
  require("../../../config_vp2019.php");
  require("functions_user.php");
  require("functions_main.php");
  require("functions_message.php");
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
  $myMessage = null;
  
  
  if(isset($_POST["submitMessage"])){
	  //saadame läbi test input 
	$myMessage = test_input($_POST["message"]);
	//kui sõnum ei ole tühi
	if(!empty($myMessage)){
		$notice = storeMessage($myMessage); //kutsutakse välja funktisoon, muutuja väärtus annakse kaasa($myMessage), korraldus mida peab tegema. $notice, oodatakse midagi tagasi
	//kui sõnumit ei ole, on tühi
	} else {
		$notice = "Tühja sõnumit ei salvestata!" ;
	}
  }
  //$messagesHTML = readAllMessages();
  $messagesHTML = readMyMessages();
  
 

  require ("header.php");
 
  
  ?>
  <?php
    echo "<h1>" .$userName .", siin saad kirjutada sõnumi</h1>";
  ?>

  <p>Kirjuta siia mingi lahe sõnum!</p>
  <hr>
  <p><a href="?logout=1">Logi välja!</a> | Tagasi <a href="home.php">avalehele</a></p>
  <br>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <label>Minu sõnum (256 märki)</label><br>
	  <textarea rows="5" cols="51" name="message" placeholder="Kirjuta siia oma sõnum ..."></textarea>
	  <br>
	  <input name="submitMessage" type="submit" value="Salvesta sõnum"><span><?php echo $notice; ?></span>
   </form>
   <br>
   <h2>Senised sõnumid</h2>
   <?php
    echo $messagesHTML;
   ?>
  
</body>
</html>