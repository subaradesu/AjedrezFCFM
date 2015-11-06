<!DOCTYPE html>
<?php session_start()?>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Historia - Ajedrez Fcfm</title>
	
	<!-- Latest compiled and minified CSS (Bootstrap)-->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	
	<!-- Ensures proper rendering on touch zooming -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- General Custom Style -->
	<link href="default.css" rel="stylesheet">
	
	<?php require_once 'utils.php';?>
	<?php checkPermission(0);?>
</head>

<body>
<?php addNavBar();?>
	
<div class="container">
	<div class=page-header>	
		<h1>Historia</h1>
	</div>
	<p>La rama de ajedrez de la facultad de ciencias físicas y matemáticas posee una larga historia dentro del país.
	Se ha destacado por alojar a numerosos y destacados ajedrecistas a nivel nacional, entre ellos diversos campeones de chile.</p> 
	<p>Los entrenamientos son llevados a cabo por el Maestro FIDE Pablo Calvo en los siguientes horarios:</p>
	<dl>
		<dt>Curso Dr:</dt>
		<dd>Martes y Jueves: 10:15 - 11:45</dd>
		<dd>Martes y Jueves: 12:00 - 13:30</dd>
		
		<dt>Entrenamiento Rama:</dt>
		<dd>Martes y Jueves: 14:00 - 16:00</dd>
	</dl>
</div>

<?php addFooter();?>

</body>
</html>