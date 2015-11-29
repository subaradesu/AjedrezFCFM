<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function getAvatarPath($avatarFilename){
		return base_url().'img/avatar/'.$avatarFilename;
	}
	
	function getCoverPath($coverFilename){
		return base_url().'img/news_cover/'.$coverFilename;
	}
	
	function prepareHTMLFromText($str){
		return str_replace('\r\n','<br>',$str);
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
	
	function translateStatus($str){
		if($str == 'active'){
			return 'Activo';
		}
		elseif($str == 'ended'){
			return 'Finalizado';
		}
		else{
			return 'Cerrado';
		}
	}
	
	/*Retorna 1 si la fecha ya pasó, 0 si no*/
	function compareWithNow($dateStr){
		$d = date_create_from_format('d-m-Y H:i:s', $dateStr);
		$now = date_create();
		$diff = date_diff($now, $d);
		return intval($diff->format('%R%a')) < 0;
	}
	
	function daysSinceLastLogin($dateStr){
		$d = date_create_from_format('Y-m-d', $dateStr);
		$now = date_create();
		$diff = date_diff($d, $now);
		return intval($diff->format('%R%a'));
	}
	
	/*Obtiene el valor para ingresarlo en dateTime en la db, retorna falso si no cumple con el formato esperado*/
	function getDBTime($dateString){
		$d = date_create_from_format('d-m-Y H:i', $dateString);
		if($d == null || ($d->format('d-m-Y H:i') != $dateString)){
			return false;
		}
		return $d->format('Y-m-d H:i:s');
	}
	
	function getCSS($str = 0){
		if($str == 'index'){
			return array('css/default.css', 'css/chessboard.css');
		}
		if($str == 'comments'){
			return array('css/default.css', 'css/comment.css');
		}
		if($str == 'login' || $str == 'register'){
			return array('css/default.css', 'css/log-register.css');
		}
		if($str == 'profile'){
			return array('css/default.css', 'css/profile.css');
		}
		if($str == 'events'){
			return array('css/default.css', 'css/events.css');
		}
		
		//default
		return array('css/default.css');
	}
	
	/*Muestra en pantalla el valor de la variable en el momento del llamado (bota la aplicacion, usar con cuidado)*/
	function debug_var($var){
			echo "<pre>";
			die(print_r($var, TRUE));
	}
	
	/*Carga la notificación de éxito*/
	function successView($heading, $message = '', $output = false){
		$CI = &get_instance();
		return $CI->load->view('simple_success', array('heading' => $heading, 'message' => $message, $output));
	}
	
	/*Carga la notificación de peligro */
	function dangerView($heading, $message = '', $output = false){
		$CI = &get_instance();
		return $CI->load->view('simple_danger', array('heading' => $heading, 'message' => $message, $output));
	}
	
	/*Carga la notificación de Información*/
	function infoView($heading, $message = '', $output = false){
		$CI = &get_instance();
		return $CI->load->view('simple_info', array('heading' => $heading, 'message' => $message, $output));
	}

?>