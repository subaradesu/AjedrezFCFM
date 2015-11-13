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
		$this_user;
		if(isset($_GET["id_user"])) :
			$this_user = $_GET["id_user"];
		else :
			$this_user = $_SESSION["username"];
		endif;
		
		//borrar publicación
		if(isset($_GET["id_publication"])){
			//me conecto a la db
			$link = mysqli_connect('localhost', 'root','','ajedrezfcfm');
			$sql ="	DELETE FROM publication
					WHERE idPublication='".$_GET["id_publication"]."'";
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
			<h1>Ver Publicaciones:</h1>
		</div>
		<div>
			<p>Acá puedes ver las publicaciones de <?php echo $this_user;?>.</p>
		</div>
		
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Titulo Publicación</th>
					<th>Descripción</th>
					<th>Fecha de Publicación</th>
					<?php if($_SESSION["permission"] == 3) : ?>
					<th>Acción</th>
					<?php endif;?>
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
				//obtengo todas las publicaciones del usuario
				$sql = "SELECT publication.idPublication AS id
						FROM userPublication AS up, publication 
						WHERE up.user_username='".$this_user."' AND up.publication_idPublication=idPublication";
				
				$query = mysqli_query($link,$sql);
				
				while($user_found = mysqli_fetch_assoc($query)) :
					//reviso cuales de estas publicaciones son noticias
					$sql2 = "SELECT idNew, title, content, date
						 	 FROM news
						 	 WHERE idNew='".$user_found["id"]."'";
					$query2=mysqli_query($link,$sql2);
					//agrego cada noticia a la tabla
					while($result2 = mysqli_fetch_assoc($query2)) : ?>
					<tr>
					<th><?php echo $result2["title"];?></th>
					<th><?php echo $result2["content"];?></th>
					<th><?php echo $result2["date"];?></th>
					<?php if($_SESSION["permission"] == 3) : ?>
					<th><a class="btn btn-lg btn-primary" href="user_publications.php?id_publication=<?php echo $result2["idNew"];?>"role="button">Borrar</a></th>
					<?php endif; ?>
					</tr>
				<?php
				endwhile;
				endwhile;
				mysqli_close($link);
			?>
			
			</tbody>
		</table>
	</div>
</div>

<?php addFooter();?>

</body>
