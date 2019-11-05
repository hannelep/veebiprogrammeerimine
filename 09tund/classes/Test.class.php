<?php
  class Test {
	  //muutujad ehk properties
	  private $privateNumber;
	  public $publicNumber;
	  
	  //funktsioonid ehk method
	  //constructor, see on funktisoon, mis käivitub üks kord, klassi kasutusele võtmisel;
	  function __construct($sentNumber){
		 $this->privateNumber = 72;
		 $this->publicNumber = $sentNumber;
		 echo "Salajase ja avaliku arvu korrutis on: " .$this->privateNumber * $this->publicNumber;
		 $this->tellSecret();
	  }
	  //destructor, käivitatakse, kui klass eemaldatakse, enam ei kasutata, töö lõppeb
	  function __destruct(){
		  echo " Klass lõpetas tegevuse!";
	  }
	  
	  private function tellSecret(){
		  echo " Salajane number on: " .$this->privateNumber;
		  
	  }
	  
	  public function tellPublicSecret() {
		 echo " Salajane number on tõesti: " .$this->privateNumber; 
	  }
  }//class lõppeb
  
  
  function setPicSize($myTempImage, $imageW, $imageH, $imageNewW, $imageNewH){
	$myNewImage = imagecreatetruecolor($imageNewW, $imageNewH);
	imagecopyresampled($myNewImage, $myTempImage, 0, 0, 0, 0, $imageNewW, $imageNewH, $imageW, $imageH);
	return $myNewImage;
  }