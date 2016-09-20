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
	$new_published = false;
	if(isset($_POST["title"]) && isset($_POST["image"]) && isset($_POST["content"]) && isset($_POST["category"])){
		//me conecto a la db
		$link = mysqli_connect('localhost', 'root','','ajedrezfcfm');
		//si no me pude conectar tiro error
		if(!$link){
			echo "Error: Unable to connect to MySQL." . PHP_EOL;
			echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
			echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
			exit;
		}
		
		//se usa begin y commit pues queremos que las transacciones sólo se realicen juntas.
		//agregar nueva publicacion, asociar al usuario con la publicacion y asociar la noticia con la publicacion
		$sql = "BEGIN;
				INSERT INTO publication
				VALUES (null);
				SELECT LAST_INSERT_ID()
				INTO @publication_id;
				INSERT INTO userPublication (user_username, publication_idPublication)
				VALUES ('".$_SESSION["username"]."', @publication_id);
				INSERT INTO news (idNew, title, date, content, image_url, category)
				VALUES (@publication_id, '".$_POST["title"]."', NOW(), '".$_POST["content"]."', '".$_POST["image"]."', '".$_POST["category"]."');
				COMMIT;";
		
		//realizo la query
		$new_published = mysqli_multi_query($link, $sql);
		
		if(!$new_published){
			echo 'error: '.mysqli_error().' '.mysqli_errno($link);
		}
		
		//cierro la conexión a la db
		mysqli_close($link);
	}
	?>
	
</head>

<body>

<?php addNavBar();?>
	
<div class="container main-content">
	<div id="content">
		<div class=page-header>
			<h1>Publicar Noticias:</h1>
		</div>
		<?php if(isset($_POST["title"]) && !$new_published) : ?>
		<div class="alert alert-warning">
			La noticia no pudo ser publicada, inténtalo de nuevo más tarde.
		</div>
		<?php elseif(isset($_POST["title"]) && $new_published) : ?>
		<div class="alert alert-success">
			<strong>¡La noticia fue publicada con éxito!</strong> Puedes verla en la pestaña de Noticias.
		</div>
		<?php endif;?>
		<div>
			<p>Acá puedes publicar noticias para que sean visibles por cualquiera que acceda a la página.</p>
			<p>Los campos con <span class="red-text">*</span> son obligatorios.</p>
		</div>
		<div class="col-sm-12">
			<form class="form-horizontal" role="form" method="POST">
				<div class="form-group">
					<label class="control-label col-sm-2" for="title">Título<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<input type="text" name="title" class="form-control" id="title" placeholder="El título de tu publicación. Ej: 5° Torneo Internacional Beauchef." required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="image">Portada<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<input type="text" name="image" class="form-control" id="image" placeholder="El enlace a la imagen que hará de portada para la publicación. Ej: goo.gl/1qaKqa." required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="category">Tipo de Publicacion:<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<select name="category" class="form-control" id="category">
							<option value="None">Ninguna</option>
							<option value="fcfm">Noticia Fcfm</option>
							<option value="nacional">Noticia Nacional</option>
							<option value="internacional">Noticia Internacional</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="content">Contenido<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<textarea name="content" class="form-control" rows="4" id="content" placeholder="El contenido de la publicación." required></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Publicar Noticia</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<?php addFooter();?>

</body>
</html>