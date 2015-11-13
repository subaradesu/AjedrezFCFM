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
	<?php checkPermission(1);?>
	
	<?php
	if(isset($_GET["id_event"])){
		//conexión a la db
		$link = mysqli_connect('localhost', 'root','','ajedrezfcfm');
		//si no me pude conectar tiro error
		if(!$link){
			echo "Error: Unable to connect to MySQL." . PHP_EOL;
			echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
			echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
			exit;
		}
	
		//defino la query para obtener los datos del evento
		$sql ="	SELECT  event.title AS title, event.description AS description, event.date AS date, event.time AS time,
						event.place AS location, event.visibility AS visibility
				FROM event
				WHERE event.publication_idPublication = '".$_GET["id_event"]."'";
	
		//realizo la query
		$query = mysqli_query($link, $sql);
		
		//guardo el resultado de la query, es a lo más una fila porque user es llave primaria
		$user_found = mysqli_fetch_assoc($query);
		
		//si el evento existe guardo sus datos
		if(count($user_found)>0){
			$title = $user_found["title"];
			$description = $user_found["description"];
			$date = $user_found["date"];
			$time = $user_found["time"];
			$location = $user_found["location"];
		}
		
		mysqli_close($link);
	}
	else{
		//redirigir o hacer magia
	}
	?>
	
</head>

<body>
<?php addNavBar();?>

<!-- En esta página se muestra el perfil simple, para el ejemplo acceder a (por ejemplo) http://localhost/AjedrezFCFM/profile.php?id_user=user01  -->

	
<div class="container">
	<div id="content">
		<div class=page-header>
			<h1>Evento "<?php echo $title;?>"</h1>
		</div>
		<div>
			<p>Descripción: <?php echo $description;?></p>
			<p><?php echo "El ".$date." en ".$location." a las ".$time; ?></p>
		</div>
		<div>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Usuario:</th>
						<th>Participación:</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				//conexión a la db
				$link = mysqli_connect('localhost', 'root','','ajedrezfcfm');
				//si no me pude conectar tiro error
				if(!$link){
					echo "Error: Unable to connect to MySQL." . PHP_EOL;
					echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
					echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
					exit;
				}
				//defino la query para obtener asistentes
				$sql ="	SELECT  user.username AS username, user.first_name AS first_name , user.last_name AS last_name, il.assistance AS assistance
						FROM invitedList as il, user
						WHERE user.username = il.invited_username AND il.idevent='".$_GET["id_event"]."'";
				
				
				//realizo la query
				$query = mysqli_query($link, $sql);
				
				while($user_found = mysqli_fetch_assoc($query)) :?>
				
					<tr>
						<th><a href="profile.php?id_user=<?php echo $user_found["username"];?>"><?php echo $user_found["first_name"].' '.$user_found["last_name"];?></a></th>
						<th><?php echo $user_found["assistance"];?></th>
					</tr>
				
				<?php
				endwhile;
				mysqli_close($link);
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php addFooter();?>

</body>
</html>