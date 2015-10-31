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

	<!-- Scripts PGN viewer -->
	<script type="text/javascript" src="http://chesstempo.com/js/pgnyui.js"></script>   
	<script type="text/javascript" src="http://chesstempo.com/js/pgnviewer.js"></script>  
	<link  type="text/css" rel="stylesheet" href="http://chesstempo.com/css/board-min.css"></link>  
	
	<!-- General Custom Style -->
	<link href="default.css" rel="stylesheet">
	
	<!-- Ensures proper rendering on touch zooming -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php require_once 'utils.php';?>
	<?php checkPermission(3);?>
	
	<?php 
	if(isset($_GET["id"])){
		//me conecto a la db
		$link = mysqli_connect('localhost', 'root','','ajedrezfcfm');
		//si no me pude conectar tiro error
		if(!$link){
			echo "Error: Unable to connect to MySQL." . PHP_EOL;
			echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
			echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
			exit;
		}
		$id = $link->real_escape_string($_GET["id"]);
		$sql = "SELECT matchboard_id, board_title FROM matchBoard WHERE matchboard_id = 1";
		//realizo la query
		$query = mysqli_query($link, $sql);
		
		if(!$query){
			echo 'error: '.mysqli_errno($link);
		}
		$row= mysqli_fetch_array($result, MYSQLI_ASSOC);
		print_r($row);
		//cierro la conexión a la db
		mysqli_close($link);
	}
	?>

	<script>
	new PgnViewer({ boardName: <?php echo $row; ?>,  
    						pgnFile: '/partida.pgn',  
    						pieceSet: 'leipzig',   	
    						pieceSize: 46  });  
	</script>  
	
</head>

<body>

<?php addNavBar();?>

	
<div class="container">
	<div id="content">
		<div class=page-header>
			<h1>Partida: <?php echo $row; ?></h1>
		</div>
		<div>
			<p>Acá puedes publicar partidas para que sean visibles por cualquiera que esté inscrito en la página.</p>
			<p>Los campos con <span class="red-text">*</span> son obligatorios.</p>
		</div>
		<div>
			
		</div>
		<table class=
		
</div>

<?php addFooter();?>

</body>
</html>