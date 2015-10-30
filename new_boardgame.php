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
	if(isset($_POST["title"]) && isset($_POST["content"]) && isset($_POST["category"]) && (isset($_POST["fileToUpload"]) || isset($_POST["textToUpload"]))){
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
			<form class="form-horizontal" role="form" method="POST">
				<div class="form-group">
					<label class="control-label col-sm-2" for="title">Título<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<input type="text" name="title" class="form-control" id="title" placeholder="El título de tu publicación. Ej: Clase 1: Aperturas" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="image">Blancas<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<input type="text" name="white" class="form-control" id="white" placeholder="Juega con blancas" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="image">Negras<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<input type="text" name="black" class="form-control" id="black" placeholder="Juega con negras" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="category">Origen de la partida:<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<select name="category" class="form-control" id="category">
							<option value="None">Ninguna</option>
							<option value="internacional">Campeonato Internacional</option>
							<option value="nacional">Campeonato Nacional</option>
							<option value="universidad">TIF Interfacultades</option>
							<option value="facultad">Torneo FCFM</option>
							<option value="amistoso">Amistoso</option>
							<option value="otro">Otro</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="content">Detalles<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<textarea name="content" class="form-control" rows="4" id="content" placeholder="El contenido de la publicación." required></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="format">Formato Partida:<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<select name="format" class="form-control" id="format" onchange="javascript:change_upload();">
							<option value="PGN">Archivo PGN</option>
							<option value="String" class="disabled">String PGN</option>
						</select>
					</div>
				</div>
				<div class="form-group" id="fileload" display="block">
					<label class="control-label col-sm-2" for="fileToUpload">Archivo<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<input type="file" name="fileToUpload" id="fileToUpload" required>
					</div>
				</div>
				<div class="form-group" id="stringload" style="display:none">
					<label class="control-label col-sm-2" for="textToUpload">String PGN<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<input type="textarea" name="textToUpload" id="textToUpload" class="form-control" rows="4" placeholder="Contenido de la partida">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Publicar Partida</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<?php addFooter();?>

</body>
</html>