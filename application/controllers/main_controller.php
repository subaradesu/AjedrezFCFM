<?php 

class main_controller extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('logging');
		$this->load->helper('html');
		$this->load->helper('url');
		//$this->session->__set('isLogged','0');
	}
	
	public function index(){
		$data = array('title' => 'Inicio');
		$this->load->view('header_board',$data);
		$this->load->view('navbar');
		$this->load->view('home');
		$this->load->view('footer');
// 		echo "<pre>";
// 		die(print_r($this->session, TRUE));
	}
	
	public function contact(){
		$this->load->view('header_general');
		$this->load->view('navbar');
		$this->load->view('contact');
		$this->load->view('footer');
	}
	
	public function news(){
		$this->load->view('header_general');
		$this->load->view('navbar');
		$this->load->view('news');
		$this->load->view('footer');
	}
	
	public function about(){
		$this->load->view('header_general');
		$this->load->view('navbar');
		$this->load->view('about');
		$this->load->view('footer');
	}
	
	public function links(){
		$this->load->view('header_general');
		$this->load->view('navbar');
		$this->load->view('links');
		$this->load->view('footer');
	}
	
	public function search_user($data = false){
		$this->load->view('header_general');
		$this->load->view('navbar');
		if(!$data){
			$this->load->view('search_user_panel');
		}
		else{
			
		}
		$this->load->view('footer');
	}
	
	public function publish_new($data = false){
		$this->load->view('header_general');
		$this->load->view('navbar');
		$this->load->view('create_new');
		$this->load->view('footer');
	}
	
	public function publish_event($data = false){
		$this->load->view('header_general');
		$this->load->view('navbar');
		$this->load->view('create_event');
		$this->load->view('footer');
	}
	
	public function publish_game($data = false){
		$this->load->view('header_general');
		$this->load->view('navbar');
		$this->load->view('create_game');
		$this->load->view('footer');
	}
	
	public function user_login(){
		$data = array('title' => 'Ingresar');
		$this->load->library('form_validation');
		
		$this->load->view('header_log_reg', $data);
		
		$this->form_validation->set_rules('user', 'Nombre de Usuario', 'required');
		$this->form_validation->set_rules('pass', 'Contraseña', 'required');
		if($this->form_validation->run()){
			$user = $this-> input ->post('user');
			$pass = $this-> input ->post('pass');
			if($logtry = $this->logging->userLogin($user, $pass)){
				$this->session->isLogged = 1;
				$this->session->username = $logtry->username;
				$this->session->sex = $logtry->sex;
				$this->session->first_name = $logtry->first_name;
				$this->session->last_name = $logtry->last_name;
				$this->session->permission = $logtry->userStatus;
				$this->session->last_log = $logtry->update_time;
				$this->load->view('navbar');
				//mensaje de bienvenida
				$this->load->view('simple_success', array(	'heading' => '¡Ingreso Exitoso!',
															'message' => ($this->session->sex == 2 ? 'Bienvenida ' : 'Bienvenido ').$this->session->first_name.' '.$this->session->last_name.'. No te veíamos desde '.$this->session->last_log.'. Disfruta tu estadía.'));
			}
			else{
				$this->load->view('navbar');
				//mensaje de fallo
				$this->load->view('simple_danger', array(	'heading' => '¡Nombre de Usuario y/o Contraseña incorrecto!',
															'message' => 'Inténtalo de nuevo'));
				$this->load->view('log_pane');
			}
		}
		else{
			$this->load->view('navbar');
			$this->load->view('log_pane');
		}
		$this->load->view('footer');
	}
	
// 	echo "<pre>";
// 	die(print_r($this->session, TRUE));
	
	public function user_logout(){
		session_destroy();
		redirect('main_controller/index');
	}
	
	public function user_register(){
		$this->load->library('form_validation');
		
		$this->load->view('header_log_reg', array('title' => 'Ingresar'));
		
		//form rules
		$this->form_validation->set_rules('user', 'Nombre de Usuario', 'required');
		$this->form_validation->set_rules('pass', 'Contraseña', 'required');
		
		if($this->form_validation->run()){
			if($register = $this->logging->userRegister()){
				//agregué al usuario
			}
			else{
				//no pude agregar al usuario
				$this->load->view('navbar');
				$this->load->view('register_pane');
			}
		}
		else{
			$this->load->view('navbar');
			$this->load->view('register_pane');
		}
		$this->load->view('footer');
	}
	
	public function user_profile(){
		$this->load->view('header_general');
		$this->load->view('navbar');
		$this->load->view('footer');
	}
	
	public function user_events(){
		$this->load->view('header_general');
		$this->load->view('navbar');
		$this->load->view('footer');
	}
	
	
	
}

?>