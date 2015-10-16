<!DOCTYPE html>
<?php session_start()?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Noticias - Ajedrez Fcfm</title>
	
	<!-- Latest compiled and minified CSS (Bootstrap)-->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	
	<!-- Ensures proper rendering on touch zooming -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- General Custom Style -->
	<link href="default.css" rel="stylesheet">
	
	<?php require_once 'utils.php';?>
	<?php checkPermission(false);?>
</head>

<body>
<?php addNavBar();?>

<div class="container">
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
		     </ol>
		<div class="carousel-inner" role="listbox">
			<div class="item active">
				<img class="first-slide" src="img/Torneo3.jpg" alt="First slide">
				<div class="container">
					<div class="carousel-caption">
		  				<h1>Tercer Torneo Chacriento</h1>
		 				<p>Culmina el tercer torneo chacriento realizado el 10 de Julio de 2015 a un ritmo rápido de 10 minutos a finish, en la foto los orgullosos ganadores de este torneo.</p>
		 				<p><a class="btn btn-lg btn-primary" href="#" role="button">Leer más</a></p>
		  			</div>
				</div>
        	</div>
        	<div class="item">
        		<img class="second-slide" src="img/Torneo2.jpg" alt="Second slide">
        		<div class="container">
					<div class="carousel-caption">
		  				<h1>Segundo Torneo Chacriento</h1>
		 				<p>Culmina el segundo torneo chacriento realizado el 3 de Julio de 2015 a un ritmo de 3' + 2", En la foto los orgullosos ganadores de este torneo.</p>
		 				<p><a class="btn btn-lg btn-primary" href="#" role="button">Leer más</a></p>
		  			</div>
				</div>
        	</div>
        	<div class="item">
        		<img class="second-slide" src="img/Torneo1.jpg" alt="Third slide">
        		<div class="container">
					<div class="carousel-caption">
		  				<h1>Primer Torneo Chacriento</h1>
		 				<p>Culmina el primer torneo chacriento realizado el 19 de Junio de 2015 a un ritmo de 3' + 2", En la foto los orgullosos ganadores de este torneo.</p>
		 				<p><a class="btn btn-lg btn-primary" href="#" role="button">Leer más</a></p>
		  			</div>
				</div>
        	</div>
		</div>
		
		<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		
		<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
		
		</div>
</div>

<?php addFooter();?>

</body>
</html>