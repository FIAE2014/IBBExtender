<?php
session_start();
?>

<?php
if(!isset($_SESSION["username"]))
   {
   echo "Bitte erst <a href=\"login.php\">einloggen</a>";
   exit;
   }else
   {
   	echo "Weiter hier:  <a href=\"main.php\">weiter</a>";
   }
?> 