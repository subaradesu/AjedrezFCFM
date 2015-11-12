<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function getAvatarPath($avatarFilename){
	return base_url().'img/avatar/'.$avatarFilename;
}

function getCoverPath($coverFilename){
	return base_url().'img/news_cover/'.$coverFilename;
}

/*Muestra en pantalla el valor de la variable en el momento del llamado (bota la aplicacion, usar con cuidado)*/
function debug_var($var){
		echo "<pre>";
		die(print_r($var, TRUE));
}

?>