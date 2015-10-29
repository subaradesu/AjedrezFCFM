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
	<?php $logtry = userLogin();?>
</head>

<body>
<?php addNavBar();?>


<div class="container">
	<!-- 	Si no estoy loggeado muestro el formulario de inicio, si falle el login muestro notificacion -->
	<?php if(!isLogged()) : ?>
		<?php if ($logtry > 0) : ?>
			<div class="alert alert-warning">
				<em>Nombre de Usuario y/o Contraseña incorrecto. Inténtalo de nuevo.</em>.
			</div>
		<?php endif;?>
		<?php if ($logtry > 2) : //TODO: mensaje de muchos reintentos.?>
		<?php endif;?>
		<div id="content">
			<form class="form-signin" action="" method="POST">
				<h2 class="form-signin-header"> Ingresar </h2>
				
				<label for="inputUsername" class="sr-only">Nombre de Usuario</label>
				<input type="text" id="inputUsername" name="user" class="form-control" placeholder="Nombre de Usuario" required autofocus>
				<label for="inputPassword" class="sr-only">Contraseña</label>
				<input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Contraseña" required>
				<div class="checkbox">
					<label>
						<input type="checkbox" value="remember-me">No cerrar sesión 
					</label>
				</div>
				<button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
				<p>¿Aún no tienes cuenta? <a href="register.php">Regístrate aquí.</a></p>
			</form>
		</div>
	<!--	Si loguié con éxito muestro mensaje de bienvenida -->
	<?php else : ?>
		<?php $s = $_SESSION["sex"]==2 ? 'Bienvenida, ' : 'Bienvenido, ';?>
		<div id="content">
			<div class="alert alert-success">
				<strong>Ingreso Exitoso!</strong> <?php echo $s. $_SESSION["first_name"].' '.$_SESSION["last_name"]. '. Disfruta tu estadía.'?>
			</div>
		</div>
	<?php endif;?>
</div>

<?php addFooter();?>
</body>

</html>