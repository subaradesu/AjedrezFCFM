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
	
	<!-- ChessBoard Style -->
	<link href="chessboard.css" rel="stylesheet">
	
	<!-- Ensures proper rendering on touch zooming -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php require_once 'utils.php';?>
	<?php checkPermission(false);?>
</head>

<body>
<?php addNavBar();?>
	
<div class="container">
	<div id="content">
		<div class=page-header>
			<h1>Bienvenido al portal de Ajedrez Fcfm</h1>
		</div>
		<div>
			<p>Te damos la bienvenida al portal de la Rama de Ajedrez de la Facultad de Ciencias Físicas y Matemáticas de la Universidad de Chile.</p>
			<p>En esta página publicaremos noticias sobre la participación de la escuela en en distintas competencias ajedrecísticas tanto internas como externas, 
			noticias relevantes con respecto al ajedrez nacional e internacional, análisis de posiciones, material de estudio, comentarios sobre partidas y mucho más.
			</p>
			<p>Por ahora te dejamos con esta entretenida posición en la cual el Maestro Capablanca le gana a un Marciano. Juegan Blancas y Ganan.</p>
			
			<?php include("capablanca.html")?>
		
			<p>Esperamos que disfrutes tu estadía y que el contenido sea de tu agrado.</p>
		</div>
	</div>
</div>

<?php addFooter();?>

</body>
</html>