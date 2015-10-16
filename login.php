<!DOCTYPE html>
<?php session_start();?>
<html lang="es">
<head>
	<!--Sets the page encoding-->
	<meta charset="UTF-8">
	<!-- page title -->
	<title>Ingresar - Ajedrez Fcfm</title>
	
	<!-- Latest compiled and minified CSS (Bootstrap)-->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	
	<!-- General Custom Style -->
	<link href="default.css" rel="stylesheet">
	<!-- login Style -->
	<link href="login.css" rel="stylesheet">
	
	<!-- Ensures proper rendering on touch zooming -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php require_once 'utils.php';?>
	<?php userLogin();?>
</head>

<body>
<?php addNavBar();?>

	
<div class="container">
	<?php 
	if(!isLogged()){
	include ("logpanel.html");
	}
	else{
	echo '
	<div id="content">
		<div class=page-header>
			<h1>Ingreso Exitoso</h1>
		</div>
	<div>
	<div>
		<p>Bienvenido ' . $_SESSION["username"] . '. Disfruta tu estadía.</p>
	</div>
	';
	}
	?>
</div>
</body>

</html>