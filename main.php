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
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.2/css/jquery.dataTables.css">

	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script src="js/jquery.form.js"></script>
	<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.2/js/jquery.dataTables.js"></script>

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
			<fieldset>
				<legend>Upload</legend>
				<label for="file">Bitte Datei auswählen:</label>
				<input type="file" name="file[]" id="file" require multiple>
				<input type="button" name="submit" value="submit" onclick="upload()"> Upload</button>
				<progress id="progress" value="0" max="100" style="width:300px;"></progress>
				<h3 id="status"></h3>
				<p id="loaded_n_total"></p>
			</fieldset>
		</form>
		
		<?php 
			
			/**
			*
			* MYSQL Verbindung / Abfrage nach Files des Owners
			*
			**/
			
			mysql_connect("localhost","admin","admin") or die("Datenbank-Verbindung fehlerhaft");
			mysql_select_db("projekt_bg_ds") or die("Tabbele nicht erreicht");

			$docpath = "C:\\xampp\htdocs\\".$username."\\";
		
			$querryfiles = "SELECT filename,filetyp,size,tag FROM documents WHERE owner LIKE $id ";
			$result = mysql_query($querryfiles);
			echo mysql_error();
			//Zeichnet eine ul mit n-li's mit dem filename
			echo "	<table id='doc_table' class='display'>
					<caption>Dateien:</caption>
					<thead>
						<tr>
							<th>Dateiname</th>
							<th>Type</th>
							<th>Größe</th>
							<th>Tags</th>
						</tr>
					</thead>
					<tbody>";
				while($row = mysql_fetch_array($result)) {
					$file = $row['filename'];
					echo "	<tr>
							<td><a href='/data/$username/$file'>".$row['filename']."</td>
							<td>".$row['filetyp']."</td>
							<td>".($row['size']/100000)." MB</td>
							<td>".$row['tag']."</td>
							</tr>";
					}
				"</tbody>
			</table>>";		 

			

			mysql_close();
		?>

		<script type="text/javascript">
			function _(el){
				return document.getElementById(el);
			}
			function upload(){
				var filearray = _("file").files;
				
				for(file in filearray){
					var formdata = new FormData();
					formdata.append('file',filearray[file]);
					console.log(filearray[file]);
					var ajax = new XMLHttpRequest();
					ajax.upload.addEventListener("progress", progressHandler, false);
					ajax.addEventListener("load", completeHandler, false);
					ajax.addEventListener("error", errorHandler, false);
					ajax.addEventListener("abort",abortHandler, false);
					ajax.open("POST","php/upload.php");
					ajax.send(formdata);
				}
				
			}

			function progressHandler(event){
				_("status").innerHTML = "Uploaded "+event.loaded+" bytes of ";
				var percent = (event.loaded / event.total) * 100;
				_("progress").value = Math.round(percent);
			}	

			function completeHandler(event){
				_("status").innerHTML = event.target.responseText;
				_("file").innerHTML = "";
				_("progress").value = 0;
			}

			function abortHandler(event){
				_("status").innerHTML = "Uploaded abgebrochen";

			}
			function errorHandler(event){
				_("status").innerHTML = "Uploaded abgebrochen";

			}
	 

		$(document).ready(function() {
			$("#doc_table").DataTable();
		});
		</script>
	</div>
	
</body>
</html>