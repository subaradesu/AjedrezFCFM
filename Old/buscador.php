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
	<?php checkPermission(0);?>
	
</head>

<body>

<?php addNavBar();?>
	
<div class="container">
	
	<?php if(isset($_GET["search"])) : ?>
	
	<div id="content">
		<div class=page-header>
			<h1>Resultados:</h1>
		</div>
		<div class="container">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Nombre</th>
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
		
		$sql = "SELECT username, first_name, last_name
				FROM user
				WHERE ".$_GET["searchby"]." LIKE '%".$_GET["search"]."%'
				ORDER BY user.".$_GET["searchby"]." ASC";
		
		
		$query = mysqli_query($link,$sql);
		
		while ($user_found = mysqli_fetch_assoc($query)) : ?>
		
		<tr>
			<th><a href="profile.php<?php echo "?id_user=".$user_found["username"];?>"><?php echo $user_found["first_name"].' '.$user_found["last_name"];?></a></th>
		</tr>
		
		<?php endwhile;?>
		
		</tbody>
	</table>
	</div>
	<?php else : ?>
	<div id="content">
		<div class=page-header>
			<h1>Buscador:</h1>
		</div>
		<div>
			<form class="form-horizontal" role="form" method="GET">
				<div class="form-group">
					<label class="control-label col-sm-2" for="search">Termino</label>
					<div class="col-sm-10">
						<input name="search" type="text" class="form-control" id="search" placeholder="Ej: Magnus">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="searchby">Buscar por:</label>
					<label class="control-label col-sm-1" for="searchby">Nombre</label>
					<div class="col-sm-1">
						<input type="radio" class="form-control" name="searchby" value="first_name" checked>
					</div>
					<label class="control-label col-sm-1" for="sex">Apellido</label>
					<div class="col-sm-1">
						<input type="radio" class="form-control" name="searchby" value="last_name">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Buscar</button>
			    	</div>
			  	</div>
			</form>
		</div>
	</div>
	<?php endif;?>
</div>
</div>

<?php addFooter();?>

</body>
</html>