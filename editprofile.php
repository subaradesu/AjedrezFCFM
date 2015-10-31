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
		
	<?php 
		$link = mysqli_connect('localhost', 'root','','ajedrezfcfm');
		$sql = "";
		if (isset($_POST["name"])){
			$sql = $sql . "UPDATE user SET first_name = '".$link->real_escape_string($_POST["name"])."' WHERE username='". $_SESSION["username"]."'; ";
		}
		if (isset($_POST["lastname"])){
			$sql = $sql . "UPDATE user SET last_name = '".$link->real_escape_string($_POST["lastname"])."' WHERE username='". $_SESSION["username"]."'; ";
		}
		if (isset($_POST["email"])){
			$sql = $sql . "UPDATE user SET email = '".$link->real_escape_string($_POST["email"])."' WHERE username='". $_SESSION["username"]."'; ";
		}		
		if (isset($_POST["sex"])){
			$sql = $sql . "UPDATE user SET sex = '".$link->real_escape_string($_POST["sex"])."' WHERE username='". $_SESSION["username"]."'; ";
		}
		if (isset($_POST["notifications"])){
			$sql = $sql . "UPDATE user SET notifications = '".$link->real_escape_string($_POST["notifications"])."' WHERE username='". $_SESSION["username"]."'; ";
		}
		if (isset($_POST["password"])){
			$sql = $sql . "UPDATE user SET password = '".$link->real_escape_string($_POST["password"])."' WHERE username='". $_SESSION["username"]."'; ";
		}
		//me conecto a la db
		
		//si no me pude conectar tiro error
		if(!$link){
			echo "Error: Unable to connect to MySQL." . PHP_EOL;
			echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
			echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
			exit;
		}
		//$link->real_escape_string($_POST["textToUpload"]);

		//se usa begin y commit pues no queremos que las transacciones se realicen juntas.
		//agregar nueva publicacion, asociar al usuario con la publicacion y asociar la noticia con la publicacion
		if($sql){
			$sql = "BEGIN; ".$sql." COMMIT;";

		echo $sql;
		//realizo la query
		$query = mysqli_multi_query($link, $sql);
		if(!$query){
			echo 'error: '.mysqli_errno($link);
		}
		}		
		//cierro la conexión a la db
		mysqli_close($link);
	?>
</head>

<body>
<?php addNavBar();?>
	
<div class="container">
	<!-- 	Si no estoy loggeado muestro el formulario de inicio, si falle el login muestro notificacion -->
	<?php if($_POST["submit"]) : ?>
		<?php if(!$query) : ?>
			<div id="content">
				<div class="alert alert-warning">
					<em>Algo falló. Inténtalo de nuevo.</em>.
				</div>
			</div>
		<!--	Si loguié con éxito muestro mensaje de bienvenida -->
		<?php else : ?>
			<?php $SESSION = $_SESSION["sex"]==2 ? 'Bienvenida, ' : 'Bienvenido, ';?>
			<div id="content">
				<div class="alert alert-success">
					<strong>Cambios guardados! Vuelva a abrir sesión para mostrar los cambios.</strong>
				</div>
			</div>
		<?php endif;?>
	<?php endif;?>
	<div id="content">
		<div class=page-header>
			<h1>Editar Perfil - <?php echo $_SESSION["username"]?></h1>
		</div>
		<div>
			<form class="form-horizontal" role="form" method="POST">
				<div class="form-group">
					<label class="control-label col-sm-2" for="name">Nombre:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="name" name="name" placeholder="Usuario">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="lastname">Apellido:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Nombre">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="email">Correo Electrónico:</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" id="email" placeholder="Correo Electronico">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="sex">Hombre:</label>
					<div class="col-sm-1">
						<input type="radio" class="form-control" name="sex" value="0" checked>
					</div>
					<label class="control-label col-sm-2" for="sex">Mujer:</label>
					<div class="col-sm-1">
						<input type="radio" class="form-control" name="sex" value="1">
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-2">Recibir Notificaciones:</label>
					<div class="col-sm-1">
						<input type="checkbox" class="form-control" id="notifications" name="notifications">
					</div>
				</div>
				
				
				<div class="form-group">
					<label class="control-label col-sm-2" for="password">Password:</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="password" name="password" placeholder="Ingresar Nueva Contraseña">
					</div>
				</div>
					<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default" name="submit" id="submit">Cambiar</button>
			    </div>
			  </div>
			</form>
		</div>
	</div>
</div>
</body>


</html>