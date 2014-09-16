 <?php
session_start();
?>

<?php
$verbindung = mysql_connect("localhost", "admin" , "admin")
or die("Verbindung zur Datenbank konnte nicht hergestellt werden");
mysql_select_db("projekt_bg_ds") or die ("Datenbank konnte nicht ausgewählt werden");

$username = $_POST["username"];
$password = md5($_POST["password"]);

$abfrage = "SELECT id, username , password FROM login WHERE username LIKE '$username' LIMIT 1";
$ergebnis = mysql_query($abfrage) or die("Query falsch");
$row = mysql_fetch_array($ergebnis);
var_dump($row);
if($row['password'] == $password)
    {
    $_SESSION["username"] = $username;
    $_SESSION["id"] = $row['id'];
    echo "Login erfolgreich. <br> <a href=\"geheim.php\">Geschützer Bereich</a>";
    }
else
    {
    echo "Benutzername und/oder Passwort waren falsch. <a href=\"index.html\">Login</a>";
    }

?> 