<?php 
defined('BASEPATH') OR exit('No direct script access allowed');




class Main_controller extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('data_model');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('general_helper');
	}
	
	public function index(){
		checkPermission(0);		
		$data = array('title' => 'Inicio');
		$this->load->view('header_board',$data);
		$this->load->view('navbar');
		$this->load->view('home');
		$this->load->view('footer');
	}
	
	public function contact(){
		checkPermission(0);
		$header_data = array('title' => 'Contacto');
		$this->load->view('header_general', $header_data);
		$this->load->view('navbar');
		$this->load->view('contact');
		$this->load->view('footer');
	}
	
	public function news(){
		checkPermission(0);
		$header_data = array('title' => 'Noticias');
		$this->load->view('header_general', $header_data);
		$this->load->view('navbar');
		$this->load->view('news',array('publications' => $this->data_model->getNews()));
		$this->load->view('footer');
	}
	
	public function about(){
		checkPermission(0);
		$header_data = array('title' => 'Historia');
		$this->load->view('header_general', $header_data);
		$this->load->view('navbar');
		$this->load->view('about');
		$this->load->view('footer');
	}
	
	public function links(){
		checkPermission(0);
		$header_data = array('title' => 'Enlaces');
		$this->load->view('header_general', $header_data);
		$this->load->view('navbar');
		$this->load->view('links');
		$this->load->view('footer');
	}
	
	public function access_denied($accessNeeded){
		$header_data = array('title' => 'Acceso denegado');
		$this->load->view('header_general',$header_data);
		$this->load->view('navbar');
		$data['title'] = '';
		$data['message'] = '';
		switch ($accessNeeded){
			case -1:
				$data['title'] = '¡Oops! Por alguna razón estás tratando de ingresar o registrarte cuando ya tienes una cuenta.';
				$data['link1'] =  '<em>Why would you do that?</em>';
				break;
			case 1:
				$data['title'] = '¡Oops! La página a la cual estás intentando acceder requiere una cuenta de usuario.';
				$data['link1'] =  anchor("user_controller/user_register","Haz click aquí"). 'para crear una cuenta.';
				break;
			case 2:
				$data['title'] = '¡Oops! La página solicitada no está disponible para ti pues te encuentras baneado.';
				$data['link1'] =  anchor("main_controller/contact","Haz click aquí"). 'para contactar a los administradores y solucionar tu situación.';
				break;
			case 3:
				$data['title'] = '¡Oops! La página a la que estás intentando acceder requiere permisos de administrador.';
				$data['link1'] =  anchor("user_controller/user_login","Haz click aquí"). 'para acceder utilizando tu cuenta.';
				break;
			default:
				//Esto no debería suceder
				debug_var("El mono se quemó");
		}
		$this->load->view('access_denied',$data);
		$this->load->view('footer');
	}
}

?>