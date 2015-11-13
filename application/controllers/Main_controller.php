<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_controller extends CI_Controller{
	
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
		$this->load->view('news',array('publications' => $this->logging->getNews()));
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
	
	public function publish_new(){
		$this->load->library('form_validation');
		$header_data = array('title' => 'Crear Noticia');
		$this->load->view('header_general',$header_data);
		$this->load->view('navbar');
		
		$this->form_validation->set_rules('title', 'Título', 'required');
		$this->form_validation->set_rules('category', 'Categoría', 'required');
		$this->form_validation->set_rules('content', 'Contenido', 'required');
		if($this->form_validation->run()){
			//la direccion donde se almacena el archivo, FCPATH es la carpeta base de CI
			$target_dir = FCPATH."img/news_cover/";
			
			$uploadOk = 1;
			
			$imageFileType = pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION);
			
			//checkeo a la mala si es una imagen y está subido
			$check = getimagesize($_FILES["image"]["tmp_name"]);
			
			if(!$check){
				//TODO: Mostrar error
				$this->load->view('simple_danger', array('heading' => 'No se pudo subir el archivo', 'message' => 'No era una imagen'));
			}
			else{
				//El archivo se subió correctamente

				$title = $this->input->post('title');
				$imageType = $imageFileType;
				$category = $this->input->post('category');
				$content = $this->input->post('content');
				if($image_name = $this->logging->createNew($_SESSION["username"],$title,$content, $imageType,$category)){
					$target_file = $target_dir . $image_name;
					move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
					$this->load->view('simple_success', array ('heading' => '¡La noticia fue subida con éxito!', 'message' => 'Ahora es visible en la pestaña de noticias'));
				}
				else{
					//la publicación no se realizó con éxito
					$this->load->view('simple_danger', array('heading' => 'La noticia no se pudo publicar', 'message' => ''));
					$this->load->view('create_new');
				}
			}
		}
		else{
			//debug_var($this->input->post());
			$this->load->view('create_new');
		}
		$this->load->view('footer');
	}
	
	public function publish_event(){
		$this->load->library('form_validation');
		$header_data = array('title' => 'Crear Evento');
		$this->load->view('header_general',$header_data);
		$this->load->view('navbar');
		
		$this->form_validation->set_rules('title', 'Título', 'required');
		$this->form_validation->set_rules('date', 'Portada', 'required');
		$this->form_validation->set_rules('location', 'Categoría', 'required');
		$this->form_validation->set_rules('time', 'Contenido', 'required');
		$this->form_validation->set_rules('description', 'Contenido', 'required');
		$this->form_validation->set_rules('visibility', 'Contenido', 'required');
		if($this->form_validation->run()){
			$title = $this->input->post('title');
			$date = $this->input->post('title');
			$location = $this->input->post('title');
			$time = $this->input->post('title');
			$description = $this->input->post('title');
			$visibility = $this->input->post('title');
			$invited_list = $this->input->post('invited');
			if($publish_try = $this->logging->createEvent($_SESSION["username"],$title, $date, $location, $time, $description, $visibility, $invited_list)){
				$this->load->view('simple_success', array ('heading' => '¡El evento fue creado con éxito!', 'message' => 'Los usuarios invitados recibirán una notificación'));
			}
			else{
				$this->load->view('simple_danger', array('heading' => 'El evento no pudo ser creado', 'message' => ''));
				$this->load->view('create_event', array('users' => $this->logging->getUsers()));
			}
		}
		else{
			$this->load->view('create_event', array('users' => $this->logging->getUsers()));
		}
		$this->load->view('footer');
	}
	
	public function publish_game(){
		$this->load->library('form_validation');
		
		$header_data = array('title' => 'Crear Partida');
	
		$this->load->view('header_general',$header_data);
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
	
	public function user_logout(){
		session_destroy();
		redirect('main_controller/index');
	}
	
	public function user_register(){
		$this->load->library('form_validation');
		
		$this->load->view('header_log_reg', array('title' => 'Registro'));
		$this->load->view('navbar');
		
		//reglas para el registro de usuario
		$this->form_validation->set_rules('user', 'Nombre de Usuario', 'required');
		$this->form_validation->set_rules('pass', 'Contraseña', 'required');
		$this->form_validation->set_rules('first_name', 'Nombre', 'required');
		$this->form_validation->set_rules('last_name', 'Apellido', 'required');
		$this->form_validation->set_rules('email', 'Corrreo Electrónico', 'required');
		
		//si recibo todos los datos para el registro
		if($this->form_validation->run()){
			$user = $this-> input ->post('user');
			$pass = $this-> input ->post('pass');
			$first_name = $this-> input ->post('first_name');
			$last_name = $this-> input ->post('last_name');
			$email = $this-> input ->post('email');
			
			if($register = $this->logging->userRegister($user, $pass, $first_name, $last_name, $email)){
				//agregué al usuario
				
				$this->load->view('simple_success', array(	'heading' => '¡Usuario registrado con éxito!',
															'message' => 'Puedes hacer ingreso al sistema con tu nombre de usuario y contraseña.'));
			}
			else{
				//no pude agregar al usuario
				//mensaje de qué pasó
				$this->load->view('simple_danger',array('heading' => 'Ocurrio un error al crear la cuenta', 'message' => ' Inténtelo de nuevo mas tarde'));
				$this->load->view('register_pane');
			}
		}
		else{
			$this->load->view('register_pane');
		}
		$this->load->view('footer');
	}
	
	public function user_profile($id_user = 0, $profile_section = 1){
		//defino los datos que usarán las vistas
		$profile_data = $this->logging->getProfileData($id_user);
		$header_data = array('title' => 'Ver Perfil - '.$profile_data["first_name"].' '.$profile_data["last_name"]);
		
		//cargo las vistas
		$this->load->view('header_profile', $header_data);
		$this->load->view('navbar');
		
		if(!$profile_data){
			//TODO: perfil no existe, hacer algo
			$this->load->view('simple_danger', array('heading' => '¡El perfil solicitado no existe!', 'message' => ''));
		}
		else{
			//si el usuario tiene un perfil asociado lo muestro
			$profile_data["avatar"] = getAvatarPath($profile_data["avatar"]);
			$data['profile_data']= $profile_data;
			//muestra la sección activa del perfil
			$data['profile_section'] = $profile_section;
			//define el contenido del perfil
			switch ($profile_section){
				case 2:
					$data['profile_content'] = $this->load->view('edit_profile', array('username' => $id_user), TRUE);
					break;
				default:
					$data['profile_content'] = $this->load->view('about', NULL, TRUE);
			}
			$this->load->view('profile',$data);
		}
		$this->load->view('footer');
	}
	
	public function user_publications($id_user = 0){
		$header_data = array('title' => 'Ver Publicaciones');
		$this->load->view('header_general', $header_data);
		$this->load->view('navbar');
		//TODO: Cargar publicaciones del usuario, pasarlas a la vista. Si el usuario no existe mostrar algo.
		$this->load->view('footer');
	}
	
	public function my_events(){
		$header_data = array('title' => 'Mis Eventos');
		$this->load->view('header_general',$header_data);
		$this->load->view('navbar');
		//TODO: Cargar Eventos del usuario actual, pasarlos a la vista de eventos.
		$this->load->view('footer');
	}
	
	public function view_event($id_event = 0){
		$header_data = array('title' => 'Ver Evento');
		$this->load->view('header_general',$header_data);
		$this->load->view('navbar');
		//TODO: Visualizar la información del evento $id_event
		
		$this->load->view('footer');
	}
	
	public function view_new($id_new = 0){
		$header_data = array('title' => 'Ver Evento');
		$this->load->view('header_general',$header_data);
		$this->load->view('navbar');
		//TODO: Visualizar la información de la noticia $id_new
		if($data_new = $this->logging->getNew($id_new)){
			$this->load->view('view_new', array('data_new' => $data_new));
		}
		else{
			$this->load->view('simple_danger', array('heading' => '¡La noticia solicitada no existe!', 'message' => ''));
		}
			
		$this->load->view('footer');
	}
	
	/*Debug artesanal - Copy Paste el código siguiente para ver la variable*/
	// 		echo "<pre>";
	// 		die(print_r($this->session, TRUE));
}

?>