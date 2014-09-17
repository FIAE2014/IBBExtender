<?php
/*=====================================
=            Upload Skript            =
=====================================*/
 
 /*==========  Session start  ==========*/
 
session_start();
$username = $_SESSION['username'];
$id = $_SESSION['id'];

/*==========  Einschränkungen  ==========*/

if ($_FILES["file"]["error"] > 0) {
  echo "Error: " . $_FILES["file"]["error"] . "<br>";
} else {
    if ($_FILES['file']['size']<1000*1000) {

  /* 
  echo "Upload: " . $_FILES["file"]["name"] . "<br>";
  echo "Type: " . $_FILES["file"]["type"] . "<br>";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
  echo "Stored in: " . $_FILES["file"]["tmp_name"];
  */
/*==========  Variablenen  ==========*/

  $filename = $_FILES['file']['name'];
  /**
    TODO: Einbau von Funktion zur Überprüfung auf Tags explode name -> for each word -> SELECT tags where word -> if 1 -> Vorschlag
  **/
  
  $type = $_FILES['file']['type'];
  $size = $_FILES['file']['size'];

 /*==========  Verschieben in User Ordner  ==========*/
 /**
 
   TODO:
   - Dynamischer machen
 
 **/
 	if (!file_exists("C:\\xampp\\htdocs\\IBBExtender\\data\\".$username."\\".$_FILES['file']['name'])) {
  		move_uploaded_file($_FILES['file']['tmp_name'], "C:\\xampp\\htdocs\\IBBExtender\\data\\".$username."\\".$_FILES['file']['name']);
  		chmod("C:\\xampp\\htdocs\\IBBExtender\\data\\".$username."\\".$_FILES['file']['name']   ,0777);
 	}else{
 		unlink($_FILES['file']['tmp_name']);
 		echo "File wurde nicht verschoben weil es bereits existiert";
 		 	}

/*==========  MYSQL INSERT  ==========*/

  mysql_connect("localhost", "admin" , "admin") or die("Datenbank Verbindung konnte nicht hergestellt werden");
  mysql_select_db("projekt_bg_ds");

  $insertquery = "INSERT INTO documents(filename,owner,filetyp,size) VALUES ('$filename','$id','$type','$size')";
  mysql_query($insertquery) or die("Query nicht erfolgreich");
  mysql_close();
}
 }
/*-----  End of Upload Skript  ------*/




 ?>