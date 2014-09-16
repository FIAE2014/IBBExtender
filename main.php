<?php
session_start();
$username = $_SESSION['username'];
$id = $_SESSION['id'];
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>IBBExtender</title>
	<style type="text/css" media="screen">
	/**
		TODO:	-Ausgliederngit
	**/
	
	.header{
		//headbar?
	}
	.leftbar{
		//nach Links
	}
	.content{
		//Main
	}	
	</style>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script src="js/jquery.form.js"></script>
</head>
<body>
	<header class="header">
		<h2>Hallo <?php echo $username; ?></h2>

	</header>
	<div class="leftbar">
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#" onclick="postData()">Dokumente</a></li>
			<li><a href="#">Chat</a></li>

		</ul>

	</div>
	<div class="content">
		<form id="uploadform" action="php/upload.php" method="POST" enctype="multipart/form-data">
			<label for="file">Bitte Datei auswählen:</label>
			<input type="file" name="file" id="file">
			<button type="submit" name="submit" value="submit"> Upload</button>
		</form>
		
		<?php 
			
			/**
			*
			* MYSQL Verbindung / Abfrage nach Files des Owners
			*
			**/
			
			
			mysql_connect("localhost","admin","admin");
			mysql_select_db("documents");

			$querryfiles = "SELECT filename FROM documents WHERE owner LIKE $id";
			$arrayfiles = mysql_query($querryfiles);

			//Zeichnet eine ul mit n-li's mit dem filename
			/**
				TODO:
				- a-Links parken
						
			**/
			
			echo "<ul>";		 
		
			foreach ($document as $arrayfiles) {
				echo "<li>".$document['filename']."</li>";
			}

			echo "</ul>";
			mysql_close();
		?>

		<script type="text/javascript">

		/* Schickt die Form per Ajax ans PHP */
		$("#uploadform").ajaxForm({	url: 'php/upload.php' ,type:'post' });

		</script>
	</div>
	
</body>
</html>