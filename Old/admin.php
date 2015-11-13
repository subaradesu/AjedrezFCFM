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
	<?php checkPermission(3);?>
	
	<?php 
	//baneo al usuario
	if(isset($_GET["id_user"])){
		//me conecto a la db
		$link = mysqli_connect('localhost', 'root','','ajedrezfcfm');
		//si no me pude conectar tiro error
		if(!$link){
			echo "Error: Unable to connect to MySQL." . PHP_EOL;
			echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
			echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
			exit;
		}
		//obtengo todos los usuarios con
		$sql = "UPDATE user
				SET userStatus='2'
				WHERE user.username='".$_GET["id_user"]."'";
		
		//echo $sql;
			
		$query = mysqli_query($link,$sql);
		mysqli_close($link);
	}
	?>
	
</head>

<body>

<?php addNavBar();?>
	
<div class="container">
	<div id="content">
		<div class=page-header>
			<h1>Página de Administración:</h1>
		</div>
		<div>
			<p>Esta es la página de administración. Administre acá.</p>
		</div>
		
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Nombre de Usuario</th>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Correo Electrónico</th>
					<th>Tipo de Usuario</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
		<?php
			//me conecto a la db
			$link = mysqli_connect('localhost', 'root','','ajedrezfcfm');
			//si no me pude conectar tiro error
			if(!$link){
				echo "Error: Unable to connect to MySQL." . PHP_EOL;
				echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
				echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
				exit;
			}
			//obtengo todos los usuarios con 
			$sql = "SELECT username, first_name, last_name, email, userStatus
					FROM user
					ORDER BY user.username ASC";
			
			$query = mysqli_query($link,$sql);
			
			while ($user_found = mysqli_fetch_assoc($query)) : ?>
			
			<tr>
				<th><?php echo $user_found["username"];?></th>
				<th><?php echo $user_found["first_name"];?></th>
				<th><?php echo $user_found["last_name"];?></th>
				<th><?php echo $user_found["email"];?></th>
				<th><?php if ($user_found["userStatus"]==1){echo "Usuario Registrado";} elseif ($user_found["userStatus"]==2){echo "Usuario Baneado";} else {echo "Usuario Administrador";}?></th>
				
				<th><a class="btn btn-lg btn-primary" href="profile.php<?php echo "?id_user=".$user_found["username"];?>">Perfil</a></th>
				
				<th><a class="btn btn-lg btn-primary" role="button" <?php echo $user_found["userStatus"]==2 ?  "Disabled" : 'href="admin.php?id_user='.$user_found["username"].'"';?>>Banear</a></th>
				
				<th><a class="btn btn-lg btn-primary" href="user_publications.php?id_user=<?php echo $user_found["username"];?>" role="button">Publicaciones</a></th>
			</tr>
			
			<?php endwhile;
			mysqli_close($link);
			?>
			
			</tbody>
		</table>
	</div>
</div>

<?php addFooter();?>

</body>
</html>