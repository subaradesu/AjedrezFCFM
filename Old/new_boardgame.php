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
	if(isset($_POST["title"]) 
		&& isset($_POST["white"]) 
		&& isset($_POST["black"]) 
		&& isset($_POST["origin"]) 		
		&& isset($_POST["content"]) 
		&& isset($_POST["format"]) 
		&& (isset($_POST["fileToUpload"]) || isset($_POST["textToUpload"]))){
		//me conecto a la db
		$link = mysqli_connect('localhost', 'root','','ajedrezfcfm');
		//si no me pude conectar tiro error
		if(!$link){
			echo "Error: Unable to connect to MySQL." . PHP_EOL;
			echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
			echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
			exit;
		}
		$filename = $_POST["fileToUpload"];
		$stringpgn = $_POST["textToUpload"];
		$format = $_POST["format"];
		if($format == 0){
			print_r($_FILES);
			print_r($_POST);
			$target_dir = "boards/";
			$target_fullpath = $target_dir . $link->real_escape_string(basename($_FILES["fileToUpload"]["name"]));
			$filename = $link->real_escape_string(basename($_FILES["fileToUpload"]["name"]));
			$uploadOk = 1;
			$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
			echo $_FILES["fileToUpload"]["tmp_name"];
			echo $fileType;
			// Check if file is an actual or fake png
			if(isset($_POST["submit"])){
			    $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
			    if($check !== false) {
			        echo "Origin file exists";
			        $uploadOk = 1;
			    }
			    else {
			        echo "File doesn't exist in origin.";
			        $uploadOk = 0;
			    }
			}
			// Check if file already exists
			if (file_exists($target_file)) {
			    echo "Sorry, file already exists in db.";
			    $uploadOk = 0;
			}
			// Check file size
			if ($_FILES["fileToUpload"]["size"] > 500000) {
			    echo "Sorry, your file is too large.";
			    $uploadOk = 0;
			}
			// Allow certain file formats
			if($fileType != "pgn") {
			    echo "Sorry, only PGN files are allowed.";
			    echo $fileType;
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			}
			else{
			    if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_fullpath)) {
			        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			    }
			    else {
			        echo "Sorry, there was an error uploading your file.";
			    }
			}
		}
		else{
			$stringpgn = $link->real_escape_string($_POST["textToUpload"]);
		}

		//se usa begin y commit pues no queremos que las transacciones se realicen juntas.
		//agregar nueva publicacion, asociar al usuario con la publicacion y asociar la noticia con la publicacion
		$sql = "BEGIN;
				INSERT INTO matchBoard (white_player, black_player, match_origin, details, format, pgn_board, pgn_string)
				VALUES ('".$_POST["white"]."', '".$_POST["black"]."', '".$_POST["origin"]."', '".$_POST["content"]."', '".$_POST["format"]."', '".$filename."', '".$stringpgn."');
				COMMIT;";
		echo $sql;
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
			<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label class="control-label col-sm-2" for="title">Título<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<input type="text" name="title" class="form-control" id="title" placeholder="El título de tu publicación. Ej: Clase 1: Aperturas" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="image">Blancas<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<input type="text" name="white" class="form-control" id="white" placeholder="Ej: Spassky, Boris V." required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="image">Negras<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<input type="text" name="black" class="form-control" id="black" placeholder="Fischer, Robert J." required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="origin">Origen de la partida:<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<select name="origin" class="form-control" id="origin">
							<option value="0" name="libro">Partida didáctica (Libro)</option>
							<option value="1" name="internacional">Campeonato Internacional</option>
							<option value="2" name="nacional">Campeonato Nacional</option>
							<option value="3" name="universidad">TIF Interfacultades</option>
							<option value="4" name="facultad">Torneo FCFM</option>
							<option value="5" name="amistoso">Amistoso</option>
							<option value="6" name="otro">Otro</option>
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
							<option value="0">Archivo PGN</option>
							<option value="1" class="disabled">String PGN</option>
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
