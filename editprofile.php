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
	<?php checkPermission(1)?>
</head>

<body>
<?php addNavBar();?>
	
<div class="container">
	<div id="content">
		<div class=page-header>
			<h1>Editar Perfil - <?php echo $_SESSION["username"]?></h1>
		</div>
		<div>
			<form class="form-horizontal" role="form">
				<div class="form-group">
					<label class="control-label col-sm-2" for="email">Nombre de Usuario:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="email" placeholder="Ingresar Nombre de Usuario">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="email">Nombre:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="email" placeholder="Usuario">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="email">Apellido:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="email" placeholder="Nombre">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="email">Correo Electrónico:</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" id="email" placeholder="Apellido">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="sex">Hombre:</label>
					<div class="col-sm-1">
						<input type="radio" class="form-control" name="sex" value="male" checked>
					</div>
					<label class="control-label col-sm-2" for="sex">Mujer:</label>
					<div class="col-sm-1">
						<input type="radio" class="form-control" name="sex" value="female">
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-2">Recibir Notificaciones:</label>
					<div class="col-sm-1">
						<input type="checkbox" class="form-control" name="noti">
					</div>
				</div>
				
				
				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">Password:</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="pwd" placeholder="Ingresar Contraseña">
					</div>
				</div>
					<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Cambiar</button>
			    </div>
			  </div>
			</form>
		</div>
	</div>
</div>
</body>


</html>