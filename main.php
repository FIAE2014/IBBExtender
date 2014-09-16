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
	<header class="header"></header>
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

	</div>
</body>
</html>