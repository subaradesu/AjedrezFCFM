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
	
</head>

<body>
<?php addNavBar();?>

<!-- En esta página se muestra el perfil simple, para el ejemplo acceder a (por ejemplo) http://localhost/AjedrezFCFM/profile.php?id_user=user01  -->

	
<div class="container">
	<div id="content">
		<div class=page-header>
			<h1>Usuario Baneado!</h1>
		</div>
		<div class="alert alert-danger">
			<p><?php echo $_SESSION["first_name"];?>, lamento informarte que te encuentras baneado de la plataforma.</p>
			<p>Comunicate con la directiva para solucionar tu situación.</p>
		</div>
	</div>
</div>

<?php addFooter();?>

</body>
</html>