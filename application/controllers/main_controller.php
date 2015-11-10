<?php 

class main_controller extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('logging');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('general_helper');
	}
	
	public function index(){
		$data = array('title' => 'Inicio');
		$this->load->view('header_board',$data);
		$this->load->view('navbar');
		$this->load->view('home');
		$this->load->view('footer');
	}
	
	public function contact(){
		$header_data = array('title' => 'Contacto');
		$this->load->view('header_general', $header_data);
		$this->load->view('navbar');
		$this->load->view('contact');
		$this->load->view('footer');
	}
	
	public function news(){
		$header_data = array('title' => 'Noticias');
		$this->load->view('header_general', $header_data);
		$this->load->view('navbar');
		$this->load->view('news');
		$this->load->view('footer');
	}
	
	public function about(){
		$header_data = array('title' => 'Historia');
		$this->load->view('header_general', $header_data);
		$this->load->view('navbar');
		$this->load->view('about');
		$this->load->view('footer');
	}
	
	public function links(){
		$header_data = array('title' => 'Enlaces');
		$this->load->view('header_general', $header_data);
		$this->load->view('navbar');
		$this->load->view('links');
		$this->load->view('footer');
	}
	
	public function search_user(){
		//TODO: revisar como hacer la búsqueda con GET
		$this->load->library('form_validation');
		$header_data = array('title' => 'Buscar Usuario');
		$this->load->view('header_general', $header_data);
		$this->load->view('navbar');
		
		$this->form_validation->set_rules('search', 'Término de Búsqueda', 'required');
		if(!$this->form_validation->run()){
			$this->load->view('search_user_panel');
		}
		else{
			$search_term = $this->input->post('search');
			$search_category = $this->input->post('searchby');
			$search_result = $this->logging->searchUser($search_term, $search_category);
			$this->load->view('search_results', array('search_result' => $search_result));
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
		$this->form_validation->set_rules('first_name', 'Nombre', 'required');
		$this->form_validation->set_rules('last_name', 'Apellido', 'required');
		$this->form_validation->set_rules('email', 'Corrreo Electrónico', 'required');
		
		if($this->form_validation->run()){
			$user = $this-> input ->post('user');
			$pass = $this-> input ->post('pass');
			$first_name = $this-> input ->post('first_name');
			$last_name = $this-> input ->post('last_name');
			$email = $this-> input ->post('email');
			
			if($register = $this->logging->userRegister($user, $pass, $first_name, $last_name, $email)){
				//agregué al usuario
				$this->load->view('navbar');
				$this->load->view('simple_success', array(	'heading' => '¡Usuario registrado con éxito!',
															'message' => 'Puedes hacer ingreso al sistema con tu nombre de usuario y contraseña.'));
			}
			else{
				//no pude agregar al usuario
				$this->load->view('navbar');
				//mensaje de qué pasó
				$this->load->view('register_pane');
			}
		}
		else{
			$this->load->view('navbar');
			$this->load->view('register_pane');
		}
		$this->load->view('footer');
	}
	
	public function user_profile($id_user = 0){
		//defino los datos que usarán las vistas
		$profile_data = $this->logging->getProfileData($id_user);
		$header_data = array('title' => 'Ver Perfil - '.$profile_data["first_name"].' '.$profile_data["last_name"]);
		
		//cargo las vistas
		$this->load->view('header_general', $header_data);
		$this->load->view('navbar');
		
		if(!$profile_data){
			//TODO: perfil no existe, hacer algo
			$this->load->view('simple_danger', array('heading' => '¡El perfil solicitado no existe!', 'message' => ''));
		}
		else{
			//si el usuario tiene un perfil asociado lo muestro
			$profile_data["avatar"] = getAvatarPath($profile_data["avatar"]);
			if($_SESSION["username"]==$profile_data["username"]){
				$this->load->view('edit_profile',$profile_data);
			}
			else{
				$this->load->view('profile',$profile_data);
			}
		}
		$this->load->view('footer');
	}
	
	public function user_publications($id_user = 0){
		$header_data = array('title' => 'Ver Publicaciones');
		$this->load->view('header_general', $header_data);
		$this->load->view('navbar');
		$this->load->view('footer');
	}
	
	public function user_events(){
		$this->load->view('header_general');
		$this->load->view('navbar');
		$this->load->view('footer');
	}
	
	/*Debug artesanal - Copy Paste el código siguiente para ver la variable*/
	// 		echo "<pre>";
	// 		die(print_r($this->session, TRUE));
}

?>