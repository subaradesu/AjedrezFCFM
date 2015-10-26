<?php
function addNavBar() {
	include ("navigation.php");
}

function addFooter(){
	include("footer.html");
}


function addLoremIpsum() {
	echo "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
}

function checkPermission($permissionNeeded){
	if($permissionNeeded>0 && !isLogged()){
		header("Location: /AjedrezFCFM/accessDenied.php");
	}
	if($permissionNeeded==3 && $_SESSION["permission"]<3){
		header("Location: /AjedrezFCFM/accessDenied.php");
	}
	if($permissionNeeded==1 && $_SESSION["permission"]==2){
		header("Location: /AjedrezFCFM/accessDenied.php");
	}
}

function userLogin(){
	//si recibí datos de login
	if(isset($_POST["user"]) && isset($_POST["pass"])){
		
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
		$sql ="	SELECT *
			FROM user
			WHERE username = '".$_POST["user"]."' AND password = '".$_POST["pass"]."'";
	
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
		}
		}
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
		//defino la query para agregar el usuario a la db
		$sql = "INSERT INTO user (username, password, first_name, last_name, email, sex, userStatus)
				VALUES ('".$_POST["user"]."', '".$_POST["pass"]."', '".$_POST["first_name"]."', '".$_POST["last_name"]. "', '".
		$_POST["email"]."', '0', '1')";
		
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