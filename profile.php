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
	$id_user;
	if(isset($_GET['id_user'])){
		$id_user = $_GET['id_user'];
	}
	else{
		$id_user=$_SESSION["username"];
	}
	//conexión a la db
	$link = mysqli_connect('localhost', 'root','','ajedrezfcfm');
	
	//si no me pude conectar tiro error
	if(!$link){
		echo "Error: Unable to connect to MySQL." . PHP_EOL;
		echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
		echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
		exit;
	}
	
	//defino la query para obtener los datos del perfil
	$sql ="	SELECT username, first_name, last_name, sex, avatar, userStatus
				FROM user
				WHERE username = '".$id_user."'";
	
	
	//realizo la query
	$query = mysqli_query($link, $sql);
	
	//guardo el resultado de la query, es a lo más una fila porque user es llave primaria
	$result = mysqli_fetch_assoc($query);
	
	//si el usuario existe importo sus datos para usarlos en el perfil
	if(count($result)>0){
		$user = $result["username"];
		$first_name = $result["first_name"];
		$last_name = $result["last_name"];
		$sex = $result["sex"];
		$avatar = $result["avatar"];
		$status = $result["userStatus"];
	}
	
	mysqli_close($link);
	
	?>
	
</head>

<body>
<?php addNavBar();?>

<!-- En esta página se muestra el perfil simple, para el ejemplo acceder a (por ejemplo) http://localhost/AjedrezFCFM/profile.php?id_user=user01  -->

	
<div class="container">
	<div id="content">
		<?php 
		if($status == 2){
			echo '<div class="alert alert-danger">
				<strong>El dueño de esta cuenta se encuentra baneado!</strong> si lo conoces pídele que se contacte con nosotros para solucionar su situación.
			</div>';
		}
		?>
		<div class=page-header>
			<h1>Perfil de <?php echo $first_name.' '.$last_name;?>:</h1>
		</div>
		<div>
			<img alt="avatar" src="<?php echo getAvatarLocation($avatar);?>">
			<p>Esta es el perfil de <?php echo $user;?>. Mire que hermoso.</p>
		</div>
		
		<?php if($id_user == $_SESSION["username"]) : ?>
		<div>
			<p><a class="btn btn-lg btn-primary" href="editprofile.php" role="button">Editar mi información</a></p>
		</div>
		<?php endif;?>
	</div>
	
	
</div>

<?php addFooter();?>

</body>
</html>