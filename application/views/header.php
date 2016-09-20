<!DOCTYPE html>
<?php //session_start();?>
<html lang="es">
<head>
	<!--Sets the page encoding-->
	<meta charset="UTF-8">
	<!-- page title -->
	<title>Ajedrez Fcfm - <?php echo $title;?></title>
	
	<!-- Ensures proper rendering on touch zooming -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- Usar css sin adjunto en el proyecto-->
	<link rel="stylesheet" href="<?php echo base_url().'css/Bootstrap/css/bootstrap.min.css'?>">
	<script src="<?php echo base_url().'css/Bootstrap/js/jquery.min.js'?>"></script>
	<script src="<?php echo base_url().'css/Bootstrap/js/bootstrap.min.js'?>"></script>
	
	<?php foreach ($css_file_paths as $css) : ?>

	<?php echo link_tag($css);?>

	<?php endforeach;?>
	
</head>

<body>
<div class="container IKUSABA">