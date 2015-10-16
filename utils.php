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

function checkPermission($needsPermission){
	if($needsPermission && !isLogged()){
		header("Location: /AjedrezFCFM/accessDenied.php");
	}
}

function userLogin(){
	if(isset($_POST["user"]) && isset($_POST["pass"])){
		$_SESSION["loggedin"] = $_POST["user"] == "user" && $_POST["pass"] == "pass";
		if($_SESSION["loggedin"]){
			$_SESSION["username"] = $_POST["user"];
		}
	}
}

function isLogged(){
	return isset($_SESSION['loggedin']) && $_SESSION["loggedin"];
}


?>