<?php
//agrega la barra de navegación superior
function addNavBar() {
	include ("navigation.php");
}

//agrega el footer de la plataforma
function addFooter(){
	include("../footer.html");
}


function addLoremIpsum() {
	echo "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
}

function getAvatarLocation($filename){
	return 'img/avatar/'.$filename;
}


function absoluteURI(){
	//TODO: crea la URI absoluta a partir de una relativa. See php reference header
}

function createComment($publisher, $idPublication, $content, $taggedUsers){
	//TODO: agrega un comentario en la publiacion con id $idPublication
}

function getPublicationContent($idPublication, $sortedBy){
	//TODO: obtiene de la db el contenido asociado a la publicacion ordenados por $sortedBy
	//titulo, contenido, comentarios (por id)
}

function addKarma($value){
	//TODO: modifica el karma de una publicación en la db
}

function cambio(){
	
}

function genericInsertQuery($sql){
	
	$link = mysqli_connect('localhost', 'root','','ajedrezfcfm');
	//si no me pude conectar tiro error
	if(!$link){
		echo "Error: Unable to connect to MySQL." . PHP_EOL;
		echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
		echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
		exit;
	}
	
	//realizo la query
	$query = mysqli_query($link, $sql);
	
	//cierro la conexión a la db
	mysqli_close($link);
	return $query;
}


//redirige a la página adecuada si el usuario no tiene los permisos
function checkPermission($permissionNeeded){
	if(!isLogged()){
		//Si necesito permisos y no estoy loggeado
		if($permissionNeeded>0){
			header("Location: accessDenied.php");
		}
	}
	//si estoy loggeado
	else{
		//si estoy banneado
		if($_SESSION["permission"]==2){ //&& $permissionNeeded!= 2
			//redirigir a página de banneados
			header("Location: banned.php");
		}
		//si necesito permisos de administrador pero no lo soy
		if($permissionNeeded==3 && $_SESSION["permission"]<3){
			//acceso denegado
			header("Location: accessDenied.php");
		}
	}
	//si llegué acá es porque tengo permisos
}

function userLogin(){
	$try = 0;
	//si recibí datos de login
	if(isset($_POST["user"]) && isset($_POST["pass"])){
		$try = 1;
		//me conecto a la base de datos
		$link = mysqli_connect('localhost', 'root','','ajedrezfcfm');
	
		//si no me pude conectar tiro error
		if(!$link){
			echo "Error: Unable to connect to MySQL." . PHP_EOL;
			echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
			echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
			exit;
		}
	
		//defino la query para buscar si se encuentra el registro en la base de datos.
		$sql ="	SELECT user.username AS username, user.first_name AS first_name, user.last_name AS last_name, user.sex AS sex, user.userStatus AS userStatus, timestamps.update_time AS update_time
				FROM user, timestamps
				WHERE user.username = '".$_POST["user"]."' AND user.password = '".$_POST["pass"]."' AND user.username=timestamps.username";
	
		//realizo la query
		$query = mysqli_query($link, $sql);
			
		$result = mysqli_fetch_assoc($query);
		
		//si el registro existe en la base de datos loggeo al usuario e importo variables
		if(count($result)>0){
			$_SESSION["loggedin"] = true;
			$_SESSION["username"] = $result["username"];
			$_SESSION["first_name"] = $result["first_name"];
			$_SESSION["last_name"] = $result["last_name"];
			$_SESSION["sex"] = $result["sex"];
			$_SESSION["permission"] = $result["userStatus"];
			$_SESSION["last_log"] = $result["update_time"];
			
			//actualizo el timestamp
			
			$sql2= "UPDATE timestamps
					SET create_time=NOW()
					WHERE username='".$_SESSION["username"]."'";
			
			mysqli_query($link,$sql2);
		}		
		mysqli_close($link);
		}
		return $try;
}

function userRegister(){
	$r = false;
	$errno = -1;
	if(isset($_POST["user"]) && isset($_POST["pass"]) && isset($_POST["email"])
			&& isset($_POST["first_name"]) && isset($_POST["last_name"])){
		//me conecto a la base de datos
		$link = mysqli_connect('localhost', 'root','','ajedrezfcfm');
		//si no me pude conectar tiro error
		if(!$link){
			echo "Error: Unable to connect to MySQL." . PHP_EOL;
			echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
			echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
			exit;
		}
		//defino la query para agregar el usuario a la db y crear el timestamp asociado
		$sql = "BEGIN;
				INSERT INTO user (username, password, first_name, last_name, email, sex, avatar, userStatus)
				VALUES ('".$_POST["user"]."', '".$_POST["pass"]."', '".$_POST["first_name"]."', '".$_POST["last_name"]. "', '".
		$_POST["email"]."', '0','defaultAvatar.jpg', '1');
				INSERT INTO timestamps
				VALUES ('".$_POST["user"]."',NOW(),NOW());
				COMMIT;";
		
		$r = mysqli_query($link, $sql);
		
		if(!$r){
			$errno = mysqli_errno($link);
		}
		
		mysqli_close($link);
	}
	return array($r, $errno);
}

function isLogged(){
	return isset($_SESSION['loggedin']) && $_SESSION["loggedin"];
}


?>