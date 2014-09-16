
<?php // R E G I S T R I E R U N G
 
$verbindung = mysql_connect("localhost", "admin" , "admin")
or die("Verbindung zur Datenbank konnte nicht hergestellt werden");

mysql_select_db("projekt_bg_ds") or die ("Datenbank konnte nicht ausgewählt werden");


if (!empty($_POST["username"]) && !empty($_POST["name"]) && !empty($_POST["firstname"]) && !empty($_POST["password"])&& !empty($_POST["password2"])&& !empty($_POST["mail"])) {
 
    $username = $_POST['username']; $name = $_POST["name"];
    $firstname = $_POST["firstname"]; $password = $_POST["password"];
    $password2 = $_POST["password2"]; $mail = $_POST["mail"];

    if($password != $password2)
        {
        $output_h1 = "Guck lieber nochmal hin!";      
        $output = "Deine Passwörter unterscheiden sich!";
        exit;
        }

    $password = md5($password);

    $result = mysql_query("SELECT id FROM login WHERE username LIKE '$username'"); 
    $menge = mysql_num_rows($result);    // Überprüfung wieviele Nutzer mit dem Namen bereits in der Datenbank registriert sind

    if($menge == 0)                      // Nur wenn das Ergebnis 0 ist, registriert er den neuen Nutzer
        {
        $eintrag = "INSERT INTO login (username, password, mail, firstname, name) VALUES ('$username', '$password', '$mail', '$firstname', '$name')";
        $eintragen = mysql_query($eintrag);

        if($eintragen)
            {
            $output_h1 = "Herzlichen Glückwunsch";    
            $output =  "Benutzer <b>$username</b> wurde erstellt.";
            $redirect = true;
            $button = "Weiter...";
            }
        else
            {
            $output_h1 = "Hier ging was schief!";     
            $output =  "Fehler beim Speichern des Benutzernames.";
            $redirect = false;
            $button = "Zurück...";
            }


        }

    else
        {
        $output_h1 = "Oops!";  
        $output =  "Benutzername schon vorhanden!";
        $redirect = false;
        $button = "Zurück...";
        }
}

mysql_close();
    
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>Login</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="description" content="Expand, contract, animate forms with jQuery wihtout leaving the page" />
        <meta name="keywords" content="expand, form, css3, jquery, animate, width, height, adapt, unobtrusive javascript"/>
        <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        
    </head>
    <body>
        <div class="wrapper">
            <div class="content">
                <div id="form_wrapper" class="form_wrapper">

                    <form class="sorry active">
                        <h3><?php if (isset($output_h1)) {echo "$output_h1";}?></h3>
                        <div>
                            <label><?php if(isset($output)){echo "$output";}?></label>
                            <?php ($redirect) ? $href = 'geheim.php' : $href ='javascript:history.back()' ?>                  
                            <span class="error">Fehler!</span>
                        </div>

                        <div class="bottom">                         
                            <a href="<?php echo $href; ?>" rel="forgot_password" id="formsend" class="linkform">
                             <?php echo "$button"; ?>
                            </a>
                            <div class="clear"></div>
                        </div>
                    </form>
                    </div>
                    </div>
                    </div>
