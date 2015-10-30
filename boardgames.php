<!DOCTYPE html>
<?php session_start();?>
<html lang="es">
<head>
	<!--Sets the page encoding-->
	<meta charset="UTF-8">
	<!-- page title -->
	<title>Ajedrez Fcfm</title>
	
	<!-- Latest compiled and minified CSS (Bootstrap)-->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	
	<!-- General Custom Style -->
	<link href="default.css" rel="stylesheet">
	
	<!-- Ensures proper rendering on touch zooming -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php require_once 'utils.php';?>
	<?php checkPermission(3);?>
	
	<?php 
	if(isset($_POST["title"]) && isset($_POST["content"]) && isset($_POST["category"])){
		//me conecto a la db
		$link = mysqli_connect('localhost', 'root','','ajedrezfcfm');
		//si no me pude conectar tiro error
		if(!$link){
			echo "Error: Unable to connect to MySQL." . PHP_EOL;
			echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
			echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
			exit;
		}
		
		//se usa begin y commit pues no queremos que las transacciones se realicen juntas.
		//agregar nueva publicacion, asociar al usuario con la publicacion y asociar la noticia con la publicacion
		$sql = "BEGIN;
				INSERT INTO chessPosition
				VALUES (null);
				SELECT LAST_INSERT_ID()
				INTO @publication_id;
				INSERT INTO userPublication (user_username, publication_idPublication)
				VALUES ('".$_SESSION["username"]."', @publication_id);
				INSERT INTO news (idNew, title, date, content, image_url, category)
				VALUES (@publication_id, '".$_POST["title"]."', NOW(), '".$_POST["content"]."', '".$_POST["image"]."', '".$_POST["category"]."');
				COMMIT;";
		
		//realizo la query
		$query = mysqli_multi_query($link, $sql);
		
		if(!$query){
			echo 'error: '.mysqli_errno($link);
		}
		
		//cierro la conexión a la db
		mysqli_close($link);
	}
	?>
	
</head>

<body>

<?php addNavBar();?>

<script type="text/javascript">
	
	function change_upload(){
		f = document.getElementById("format");
		if(f.selectedIndex == 0){
			document.getElementById("fileload").style.display="block";
			document.getElementById("fileToUpload").required = true;
			document.getElementById("stringload").style.display="none";
			document.getElementById("textToUpload").required = false;
			document.getElementById("textToUpload").value=null;
		}
		else {
			document.getElementById("fileload").style.display="none";
			document.getElementById("fileToUpload").required = false;
			document.getElementById("fileToUpload").value=null;
			document.getElementById("stringload").style.display="block";
			document.getElementById("textToUpload").required = true;
		}
	};
</script>
	
<div class="container">
	<div id="content">
		<div class=page-header>
			<h1>Nueva Partida:</h1>
		</div>
		<div>
			<p>Acá puedes publicar partidas para que sean visibles por cualquiera que esté inscrito en la página.</p>
			<p>Los campos con <span class="red-text">*</span> son obligatorios.</p>
		</div>
		<div class="col-sm-12">
			<table width="100%">
				<tr>
					<td>Título</td>
					<td>Blancas</td>
					<td>Negras</td>
					<td>Descripción</td>
				</tr>
				<?php
					echo "<tr>";
					for($i=0; $i<5; $i++){
						echo "<td>$i</td>";
					}
					echo "</tr>";
				?>
			</table>
		</div>
	</div>
</div>

<?php addFooter();?>

</body>
</html>