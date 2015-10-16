<!DOCTYPE html>
<?php session_start()?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Contacto - Ajedrez Fcfm</title>
	
	<!-- Latest compiled and minified CSS (Bootstrap)-->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	
	<!-- Ensures proper rendering on touch zooming -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php require_once 'utils.php';?>
	<?php checkPermission(false);?>
</head>

<body>

<?php addNavBar();?>
	
<div class="container">
	<div class=page-header>
	<h1>Contacto</h1>
	</div>
	<div>
	<p>La Rama de ajedrez realiza sus entrenamientos en la sala de juegos de la FCFM, ubicada en el edificio Beauchef 851, Piso -3.</p>
	
	<p>Cualquier duda o sugerencia contactar a la directiva mediante los siguientes correos o bien :<p>
	
	<div class="container">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Nombre:</th>
				<th>Cargo:</th>
				<th>E-mail:</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>Mauricio Muñoz Robledo</th>
				<th>Presidente</th>
				<th>ajedrez@ing.uchile.cl</th>
			</tr>
			<tr>
				<th>Juan Perez Urrea</th>
				<th>Vice-Presidente</th>
				<th>ajedrez@ing.uchile.cl</th>
			</tr>
			<tr>
				<th>Kevin Rosero Pilicita</th>
				<th>Delegado</th>
				<th>ajedrez@ing.uchile.cl</th>
			</tr>
			<tr>
				<th>Alexis Apablaza de la Cuadra</th>
				<th>Delegado</th>
				<th>ajedrez@ing.uchile.cl</th>
			</tr>
		</tbody>
		
	</table>
	</div>
	
	
	</div>
</div>

</body>
</html>