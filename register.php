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
	
	<!-- General Custom Style -->
	<link href="default.css" rel="stylesheet">
	
	<!-- login Style -->
	<link href="login.css" rel="stylesheet">
	
	<?php require_once 'utils.php';?>
	<?php checkPermission(0);?>
	<?php list($registerSuccess, $errno) = userRegister();?>
</head>

<body>
<?php addNavBar();?>
	
<div class="container">
	<div id="content">
		<?php
		if(!$registerSuccess){
		//el registro falló
			if($errno == -1){
				//No hay nada extraño, no traté de registrar
			}
			elseif($errno == 1062){
				//1062 = registro duplicado en la db (username repetido)
				echo '<div class="alert alert-warning">
						<em>Lo sentimos. El nombre de usuario ingresado no se encuentra disponible. Intenta utilizando uno nuevo</em>.
					  </div>';
			}
			else{
				//no tengo idea que pasó pero no debería haber pasado.
				echo "Sucedió algo inesperado en el proceso de registro. Por favor inténtalo de nuevo.";
			}
			include("registerpanel.html");
		}
		else{
		//registro exitoso!
			echo '<div class="alert alert-success">¡El registro se ha llevado a cabo con éxito! Ahora puedes ingresar al sitio haciendo <a href="login.php">click aquí</a></div>'; 
		//TODO: 
		}?>
	</div>
</div>

<?php addFooter();?>
</body>


</html>