<!DOCTYPE html>
<?php session_start();?>
<html lang="es">
<head>
	<!--Sets the page encoding-->
	<meta charset="UTF-8">
	<!-- page title -->
	<title>Registro - Ajedrez Fcfm</title>
	
	<!-- Latest compiled and minified CSS (Bootstrap)-->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	
	<!-- Ensures proper rendering on touch zooming -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php require_once 'utils.php';?>
</head>

<body>
<?php addNavBar();?>

<div class="container">
	<div id="content">
		<div class=page-header>
			<h1>Registro de Usuario</h1>
		</div>
		<div>
			<p>¡Oops! La página a la que estás intentando acceder requiere permisos adicionales.</p>
			<p><a href="/login.php">Haz click aquí</a> para acceder utilizando tu cuenta.</p>
			<p><a href="javascript:history.back(1)">Haz click aquí</a> para volver a la página anterior.</p>
		</div>
	</div>
</div>
</body>


</html>