<!DOCTYPE html>
<?php session_start();?>
<html lang="es">
<head>
	<!--Sets the page encoding-->
	<meta charset="UTF-8">
	<!-- page title -->
	<title>Mi cuenta - Ajedrez Fcfm</title>
	
	<!-- Latest compiled and minified CSS (Bootstrap)-->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	
	<!-- Ensures proper rendering on touch zooming -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php require_once 'utils.php';?>
	<?php checkPermission(true)?>
</head>

<body>
<?php addNavBar();?>
	
<div class="container">
	<div id="content">
		<div class=page-header>
			<h1>Mi Cuenta</h1>
		</div>
		<div>
			<p>Acá está toda la información del user... (?)</p>
		</div>
		<div>
			<p><a class="btn btn-lg btn-primary" href="editprofile.php" role="button">Editar mi información</a></p>
		</div>
	</div>
</div>
</body>


</html>