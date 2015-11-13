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
	if(isset($_GET["id_event"]) && isset($_GET["r"])){
		$sql = "REPLACE INTO invitedList VALUES ('".$_GET["id_event"]."', '".$_SESSION["username"]."','".$_GET["r"]."','0')";
		genericInsertQuery($sql);
	}
	?>
	
</head>

<body>

<?php addNavBar();?>
	
<div class="container main-content">
	<div id="content">
		<div class=page-header>
			<h1>Mis Eventos:</h1>
		</div>
		<div>
			<p>Acá puedes ver tus eventos.</p>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<h2>Eventos Privados:</h2>
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
				$sql = "SELECT 	event.publication_idPublication AS id_event, event.title AS title, event.description AS description, event.date AS date, event.time AS time,
								event.place AS location, event.visibility AS visibility, il.show_notification AS notification, il.assistance AS assistance
						FROM invitedList AS il, event
						WHERE il.invited_username='".$_SESSION["username"]."' AND il.idevent=event.publication_idPublication AND visibility='private'";
				
				
				$query = mysqli_query($link, $sql);
				
				if(!$query){
					echo mysqli_error($link);
				}
				
				while($user_found = mysqli_fetch_assoc($query)) : ?>
				<div class="alert alert-success">
					<p><strong><?php echo $user_found["title"];?></strong></p>
					<p><?php echo "El ".$user_found["date"]." en ".$user_found["location"]." a las ".$user_found["time"]; ?></p>
					<p><?php echo $user_found["description"];?></p>
					<p>Confirmar Asistencia.<p>
				</div>
				<?php
				endwhile;
				//cierro la conexión a la db
				mysqli_close($link);
				?>
			</div>
			<div class="col-sm-6">
				<h2>Eventos Públicos:</h2>
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
				$sql = "SELECT 	event.publication_idPublication AS id_event, event.title AS title, event.description AS description, event.date AS date, event.time AS time,
								event.place AS location, event.visibility AS visibility, il.show_notification AS notification, il.assistance AS assistance
						FROM invitedList AS il, event
						WHERE il.invited_username='".$_SESSION["username"]."' AND il.idevent=event.publication_idPublication AND visibility='public'";
				$query = mysqli_query($link, $sql);
				
				if(!$query){
					echo mysqli_error($link);
				}
				
				while($user_found = mysqli_fetch_assoc($query)) : ?>
				<div class="alert alert-success">
					<p><strong><a href="viewevent.php?id_event=<?php echo $user_found["id_event"];?>"><?php echo $user_found["title"];?></a></strong></p>
					<p><?php echo "El ".$user_found["date"]." en ".$user_found["location"]." a las ".$user_found["time"]; ?></p>
					<p><?php echo $user_found["description"];?></p>
					<p>
						<a href="myevents.php?<?php echo "id_event=".$user_found["id_event"]."&r=Asistiré";?>">Asistiré</a> 
						<a href="myevents.php?<?php echo "id_event=".$user_found["id_event"]."&r=No+Asistiré";?>">No Asistiré</a>
					<p>
				</div>
				<?php
				endwhile;
				//cierro la conexión a la db
				mysqli_close($link);
				?>
			</div>
		</div>
	</div>
</div>

<?php addFooter();?>

</body>
</html>