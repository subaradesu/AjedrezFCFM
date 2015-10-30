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
	$event_created = false;
	//title, date, time, location, description, visibility 
	if(isset($_POST["title"])){
		//me conecto a la db
		$link = mysqli_connect('localhost', 'root','','ajedrezfcfm');
		//si no me pude conectar tiro error
		if(!$link){
			echo "Error: Unable to connect to MySQL." . PHP_EOL;
			echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
			echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
			exit;
		}
		
		//se usa begin y commit pues queremos que las transacciones sólo se realicen juntas.
		//agregar nueva publicacion, asociar nuevo evento a la publicacion, asociar usuarios con el evento
		$sql = "BEGIN;
				INSERT INTO publication
				VALUES (null);
				SELECT LAST_INSERT_ID()
				INTO @publication_id;
				INSERT INTO event (publication_idPublication, title, description, date, time, place, visibility)
				VALUES (@publication_id, '".$_POST["title"]."', '".$_POST["description"]."', '".$_POST["date"]."', '".$_POST["time"]."', '".$_POST["location"]."', '".$_POST["visibility"]."');";
		
		if($_POST["visibility"] == "private"){
			foreach ($_POST["invited"] as $selectedOption){
				$sql = 	$sql.
						"INSERT INTO invitedList
						 VALUES (@publication_id,'".$selectedOption."','Por Confirmar.','1');";
			}
		}
		
		$sql = $sql ."COMMIT;";
		
		//realizo la query
		$event_created = mysqli_multi_query($link, $sql);
		
		if(!$event_created){
			echo 'error: '.mysqli_error().' '.mysqli_errno($link);
		}
		//cierro la conexión a la db
		mysqli_close($link);
	}
	?>
	
	
</head>

<body>

<?php addNavBar();?>
	
<div class="container main-content">
	<div id="content">
		<div class=page-header>
			<h1>Crear Evento:</h1>
		</div>
		<?php if(isset($_POST["title"]) && !$event_created) : ?>
		<div class="alert alert-warning">
			La evento no pudo ser creado, inténtalo de nuevo más tarde.
		</div>
		<?php elseif(isset($_POST["title"]) && $event_created) : ?>
		<div class="alert alert-success">
			<strong>¡El evento fue creado con éxito!</strong> Los usuarios invitados podrán verlo en su pestaña de eventos.
		</div>
		<?php endif;?>
		<div>
			<p>Acá puedes crear eventos dentro de la plataforma. Los usuarios invitados podrán ver el evento en su pestaña de eventos.</p>
			<p>Los campos con <span class="red-text">*</span> son obligatorios.</p>
		</div>
		<div class="col-sm-12">
			<form class="form-horizontal" role="form" method="POST">
				<div class="form-group">
					<label class="control-label col-sm-2" for="title">Título<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<input type="text" name="title" class="form-control" id="title" placeholder="El título de tu publicación. Ej: 5° Torneo Internacional Beauchef." required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="date">Fecha<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<input type="text" name="date" class="form-control" id="date" placeholder="Fecha de realización del evento." required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="location">Lugar<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<input type="text" name="location" class="form-control" id="location" placeholder="Lugar de realización del evento." required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="time">Horario<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<input type="text" name="time" class="form-control" id="time" placeholder="Hora de realización del evento." required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="description">Contenido<span class="red-text">*</span>:</label>
					<div class="col-sm-8">
						<textarea name="description" class="form-control" rows="2" id="description" placeholder="Pequeña descripción sobre el evento." required></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="visibility">Tipo de Evento<span class="red-text">*</span>:</label>
					<label class="control-label col-sm-2" for="visibility">Público</label>
					<div class="col-sm-1">
						<input type="radio" name="visibility" class="form-control" id="visibility" value="public" checked="checked">
					</div>
					<label class="control-label col-sm-2" for="visibility">Privado</label>
					<div class="col-sm-1">
						<input type="radio" name="visibility" class="form-control" id="visibility" value="private">
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-2" for="invited[]">Invitados<span class="red-text"></span>:</label>
					<div class="col-sm-8">
						<select name="invited[]" multiple>
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
							
							$sql = "SELECT username,first_name,last_name
									FROM user
									WHERE username <> '".$_SESSION["username"]."'
									ORDER BY first_name ASC;";
							
							$query = mysqli_query($link, $sql);
							
							while($result = mysqli_fetch_assoc($query)) :
							?>
							<option value="<?php echo $result["username"];?>"><?php echo $result["first_name"].' '.$result["last_name"]?></option>
							<?php
							endwhile;
							mysqli_close($link);
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Publicar Evento</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<?php addFooter();?>

</body>
</html>