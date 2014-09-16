<?php
session_start();
$username = $_SESSION['username'];
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>IBBExtender</title>
	<style type="text/css" media="screen">
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
</head>
<body>
	<header class="header">
		<h2>Hallo <?php echo $username; ?></h2>

	</header>
	<div class="leftbar">
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">Dokumente</a></li>
			<li><a href="#">Chat</a></li>

		</ul>

	</div>
	<div class="content">
		<form action="php/upload.php" method="POST" enctype="multipart/form-data">
			<label for="file">Bitte Datei auswählen:</label>
			<input type="file" name="file" id="file">
			<button type="submit" name="submit" value="submit"> Upload</button>
		</form>
		<?php
		mysql_connect(...)
		array <- SELECT documentes WHERE owner LIKE $username

		foreach ($array as $document) {
			<li>Dokumentlink</li>
		}
		
		?>
	</div>
</body>
</html>