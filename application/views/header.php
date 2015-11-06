<!DOCTYPE html>
<?php //session_start();?>
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
	<?php echo link_tag('css/default.css');?>
	
	<!-- ChessBoard Style -->
	<?php echo link_tag('css/chessboard.css');?>
	
	<!-- Ensures proper rendering on touch zooming -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php
	//cargar utilidades
	//require_once 'utils.php';
	?>
	
	<?php
	//Comprobar si tengo permisos para ingresar a esta página
	//checkPermission(0);
	?>
	
</head>

<body>
<div class="container main-content">