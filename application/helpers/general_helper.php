<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function getAvatarPath($avatarFilename){
		return base_url().'img/avatar/'.$avatarFilename;
	}
	
	function getCoverPath($coverFilename){
		return base_url().'img/news_cover/'.$coverFilename;
	}
	
	function checkPermission($permissionNeeded){
		if(!isset($_SESSION["isLogged"])){
			//Si necesito permisos y no estoy loggeado
			if($permissionNeeded>0){
				redirect('main_controller/access_denied/1');
			}
		}
		//si estoy loggeado
		else{
			//si es requisito no estar loggeado
			if($permissionNeeded < 0){
				//acceso denegado
				redirect('main_controller/access_denied/-1');
			}
			if($permissionNeeded > 0){
				//si estoy banneado
				if($_SESSION["permission"]==2){ //&& $permissionNeeded!= 2
					//redirigir a página de banneados
					redirect('main_controller/access_denied/2');
				}
			}
			//si necesito permisos de administrador pero no lo soy
			if($permissionNeeded==3 && $_SESSION["permission"]<3){
				//acceso denegado
				redirect('main_controller/access_denied/3');
			}
		}
	}
	
	/*Muestra una vista de éxito con el titulo y el mensaje ingresados*/
	function successView($heading, $message=''){
		$this->load->view('simple_success', array('heading' => $heading, 'message' => $message));
	}
	
	/*Muestra una vista de peligro con el titulo y el mensaje ingresados*/
	function dangerView($heading, $message=''){
		$this->load->view('simple_danger', array('heading' => $heading, 'message' => $message));
	}
	
	/*Obtiene el valor para ingresarlo en dateTime en la db, retorna falso si no cumple con el formato esperado*/
	function getDBTime($dateString){
		$d = date_create_from_format('d-m-Y H:i', $dateString);
		if($d == null || ($d->format('d-m-Y H:i') != $dateString)){
			return false;
		}
		return $d->format('Y-m-d H:i:s');
	}
	
	/*Muestra en pantalla el valor de la variable en el momento del llamado (bota la aplicacion, usar con cuidado)*/
	function debug_var($var){
			echo "<pre>";
			die(print_r($var, TRUE));
	}

?>