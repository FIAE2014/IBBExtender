<?php 
session_start();
$username = $_SESSION['username'];
$id = $_SESSION['id'];

if ($_FILES["file"]["error"] > 0) {
  echo "Error: " . $_FILES["file"]["error"] . "<br>";
} else {
  echo "Upload: " . $_FILES["file"]["name"] . "<br>";
  echo "Type: " . $_FILES["file"]["type"] . "<br>";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
  echo "Stored in: " . $_FILES["file"]["tmp_name"];

  $filename = $_FILES['file']['name'];
  $type = $_FILES['file']['type'];
  $size = $_FILES['file']['size'];
 
  	move_uploaded_file($_FILES['file']['tmp_name'], "C:\\xampp\\htdocs\\IBBExtender\\data\\".$username."\\".$_FILES['file']['name']);

	mysql_connect("localhost", "admin" , "admin") or die("Datenbank Verbindung konnte nicht hergestellt werden");
	mysql_select_db("projekt_bg_ds");

	$insertquery = "INSERT INTO documents(filename,owner,filetyp,size) VALUES ('$filename','$id','$type','$size')";
	mysql_query($insertquery) or die("Query nicht erfolgreich");
	mysql_close();
}
 ?>