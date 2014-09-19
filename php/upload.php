<?php
/*=====================================
=            Upload Skript            =
=====================================*/
 
 /*==========  Session start  ==========*/
 
session_start();
$username = $_SESSION['username'];
$id = $_SESSION['id'];

/*==========  Einschränkungen  ==========*/

if (empty($_FILES['file'])) 
{
  echo "Error: " . $_FILES["file"]["error"] . "<br>";
  

}
else 
{
	
	  $filename 	= $_FILES['file']['name'];
	  $tmp 			= $_FILES['file']['tmp_name'];
	  /**
	    TODO: Einbau von Funktion zur Überprüfung auf Tags explode name -> for each word -> SELECT tags where word -> if 1 -> Vorschlag
	  **/
	  
	  $type 		= $_FILES['file']['type'];
	  $size 		= $_FILES['file']['size'];


	 	if (!file_exists("C:\\xampp\\htdocs\\IBBExtender\\data\\".$username."\\".$filename)) 
	 	{
	  		move_uploaded_file($_FILES['file']['tmp_name'], "C:\\xampp\\htdocs\\IBBExtender\\data\\".$username."\\".$filename);
	  		chmod("C:\\xampp\\htdocs\\IBBExtender\\data\\".$username."\\".$filename   ,0777);
	  	
		 	write_into_database($filename,$id,$type,$size);

	 	}else
	 	{
	 		unlink($tmp);
	 		echo "File wurde nicht verschoben weil es bereits existiert";
	 	}

	 

 }
/*-----  End of Upload Skript  ------*/

/**
 * [write_into_database description] 
 * Schreibt die Werte in die Datenbank
 * TODO:Auslagern und per include
 * @return [type] [description]
 */
function write_into_database($filename,$id,$type,$size){

	  mysql_connect("localhost", "admin" , "admin") or die("Datenbank Verbindung konnte nicht hergestellt werden");
	  mysql_select_db("projekt_bg_ds");

	  $insertquery = "INSERT INTO documents(filename,owner,filetyp,size) VALUES ('$filename','$id','$type','$size')";
	  mysql_query($insertquery) or die("Query nicht erfolgreich");
	  mysql_close();

}

 ?>