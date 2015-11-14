<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

define("MAX_AVATARSIZE", 1000000); //1MB limit
define("MAX_AVATARWIDTH", 600);
define("MAX_AVATARHEIGHT", 600);


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
		$this->load->view('news',array('publications' => $this->logging->getNews()));
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
	
	public function search_user(){
		checkPermission(1);
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
		checkPermission(3);
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
	
	public function admin($action = 'none', $id_user = 0){
		checkPermission(3);
		$header_data = array('title' => 'Administrar');
		$this->load->view('header_general',$header_data);
		$this->load->view('navbar');
		if($action == 'ban'){
			$this->logging->changeStatus($id_user, 2);
		}
		elseif($action == 'unban'){
			$this->logging->changeStatus($id_user, 1);
		}
		//TODO: Cargar vista de administración
		$this->load->view('admin',array('users' => $this->logging->getUsers('admin')));
		$this->load->view('footer');
	}
	
	public function publish_event(){
		checkPermission(3);
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
			$date = $this->input->post('date');
			$location = $this->input->post('location');
			$time = $this->input->post('time');
			$description = $this->input->post('description');
			$visibility = $this->input->post('visibility');
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
		checkPermission(3);
		$this->load->library('form_validation');
		$header_data = array('title' => 'Crear Partida');
		$this->load->view('header_general',$header_data);
		$this->load->view('navbar');

		$this->form_validation->set_rules('title', 'Título', 'required');
		$this->form_validation->set_rules('white', 'Blancas', 'required');
		$this->form_validation->set_rules('black', 'Negras', 'required');
		$this->form_validation->set_rules('origin', 'Origen', 'required');
		$this->form_validation->set_rules('content', 'Detalles', 'required');
		$this->form_validation->set_rules('format', 'Formato', 'required');
		if($this->form_validation->run()){
			$title = $this->input->post('title');
			$white = $this->input->post('white');
			$black = $this->input->post('black');
			$origin = $this->input->post('origin');
			$content = $this->input->post('content');
			$format = $this->input->post('format');
			$filename="";
			$stringpgn="";
			if($format == 0 && !empty($_FILES['fileToUpload']['name'])){
				$target_dir = "boards/";
				$target_fullpath = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$filename = basename($_FILES['fileToUpload']['name']);
				$uploadOk = 1;
				$fileType = pathinfo($target_fullpath,PATHINFO_EXTENSION);
				// Check if file is an actual or fake png
				if(isset($_POST["submit"])){
				    $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
				    if($check !== false) {
				        //echo "Origin file exists";
				        $uploadOk = 1;
				    }
				    else {
				        $uploadOk = 0;
				    }
				}
				// Check if file already exists
				if (file_exists($target_fullpath)) {
				    $uploadOk = 0;
				}
				// Check file size
				if ($_FILES["fileToUpload"]["size"] > 500000) {
				    $uploadOk = 0;
				}
				// Allow certain file formats
				if($fileType != "pgn") {
				    $uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
				    echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
			}
			else{
			    if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_fullpath)) {
			        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			    }
			    else {
			        echo "Sorry, there was an error uploading your file.";
			    }
			}
		}
			else {
				$stringpgn = $this->input->post('textToUpload');
			}
			if($publish_try = $this->logging->createGame($_SESSION["username"],$title, $white, $black, $origin, $content, $format, $filename, $stringpgn)){
				$this->load->view('simple_success', array ('heading' => '¡La partida fue creada con éxito!', 'message' => ''));
				//$this->output->set_header('refresh:5;url='.$this->);
			}
			else{
				$this->load->view('simple_danger', array('heading' => 'La partida no pudo ser creada', 'message' => ''));
				$this->load->view('create_game', array('users' => $this->logging->getUsers()));
			}
		}
		else{
			$this->load->view('create_game', array('users' => $this->logging->getUsers()));
		}
		//$this->load->view('create_game');
		$this->load->view('footer');
	}
	
	public function view_boardgame($id_boardgame = 0){
		checkPermission(1);
		$header_data = array('title' => 'Ver Evento');
		$this->load->view('header_general',$header_data);
		$this->load->view('navbar');
		if($data_boardgame = $this->logging->getBoardgame($id_boardgame)){
			$this->load->view('view_boardgame', array('data_boardgame' => $data_boardgame));
		}
		else{
			$this->load->view('simple_danger', array('heading' => '¡La partida solicitada no existe!', 'message' => ''));
		}
		$this->load->view('footer');
	}
	
	public function user_login(){
		checkPermission(-1);
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
				if($_SESSION["permission"] == 2){
					$this->load->view('simple_danger', array(	'heading' => 'Ingreso Exitoso...',
							'message' => ($this->session->sex == 2 ? 'Bienvenida ' : 'Bienvenido ').$this->session->first_name.' '.$this->session->last_name.'. No te veíamos desde '.$this->session->last_log.'. <p>Al parecer tu cuenta se encuentra baneada, contáctate con los administradores para solucionar tu situación. Por ahora tienes acceso limitado al sitio.</p>'));
				}
				else{
					$this->load->view('simple_success', array(	'heading' => '¡Ingreso Exitoso!',
							'message' => ($this->session->sex == 2 ? 'Bienvenida ' : 'Bienvenido ').$this->session->first_name.' '.$this->session->last_name.'. No te veíamos desde '.$this->session->last_log.'. Disfruta tu estadía.'));
				}
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
		checkPermission(-1);
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
	
	public function user_profile($id_user = 0, $profile_section = 1, $action = 'none'){
		checkPermission(1);
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
				case 1:
					//TODO: Mostrar información del perfil
					$data['profile_content'] = $this->load->view('profile_overview', NULL, TRUE);
					break;
				case 2:
					//TODO: Editar Información Perfil
					//TODO: Esto es super sucio, revisar
					$update_data = null;
					if(($name = $this->input->post('name')) != null){
						$update_data["first_name"]=$name;
					}
					if(($lastname = $this->input->post('lastname')) != null){
						$update_data["last_name"]=$lastname;
					}
					if(($email = $this->input->post('email')) != null){
						$update_data["email"]=$email;
					}
					if(($sex = $this->input->post('sex')) != null && $sex != $profile_data["sex"]){
						$update_data["sex"]=$sex;
					}
					if(($password = $this->input->post('password')) != null){
						//TODO: revisar restricciones para la nueva contraseña (?)
						$update_data["password"]=$password;
					}
					//Si se subió una imagen
					//checkeo a la mala si es una imagen y está subido
					if(isset($_FILES["avatar"]["tmp_name"]) && file_exists($_FILES["avatar"]["tmp_name"])){
						if(!($check = getimagesize($_FILES["avatar"]["tmp_name"]))){
							//no era imagen, mostrar error
							$this->load->view('simple_danger', array('heading' => 'No se pudo subir el archivo', 'message' => 'No era una imagen'));
						}
						elseif ($_FILES["avatar"]["size"] > MAX_AVATARSIZE){
							//TODO: hacer algo para que no se suba la imagen
							debug_var("ARCHIVO MUY GRANDE!");
						}
						elseif ($check[0] > MAX_AVATARWIDTH || $check[1] > MAX_AVATARHEIGHT){
							//TODO: hacer algo para que no se suba bla bla
							debug_var("IMAGEN MUY GRANDE!");
						}
						else{
							//la direccion donde se almacena el archivo, FCPATH es la carpeta base de CI
							$target_dir = FCPATH."img/avatar/";
							$imageFileType = pathinfo($_FILES["avatar"]["name"],PATHINFO_EXTENSION);
							$filename = $id_user.'.'.$imageFileType;
							$target_file = $target_dir .$filename;
							move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
							$update_data["avatar"] = $filename;
						}
						
					}
					//reviso si estoy tratando de actualizar
					if($update_data != null){
						if($update = $this->logging->updateProfileData($id_user, $update_data)){
							$data['profile_content'] = $this->load->view('simple_success', array('heading' => 'Actualización realizada con éxito', 'message' => ''), TRUE);
						}
						else{
							//TODO: traté de updatear y no funcó, mostrar error
						}
					}
					else{
						$data['profile_content'] = $this->load->view('profile_edit', $profile_data, TRUE);
					}
					break;
				case 3:
					//TODO: Enviar Mensaje
					$data['profile_content'] = $this->load->view('simple_danger', array('heading' => '¡Lo sentimos!', 'message' => 'Por el momento esta sección no se encuentra implementada.'), TRUE);
					break;
				case 4:
					//TODO: Ver Publicaciones
					$data['profile_content'] = $this->load->view('simple_danger', array('heading' => '¡Lo sentimos!', 'message' => 'Por el momento esta sección no se encuentra implementada.'), TRUE);;
					break;
				case 5:
					//TODO: Ver Estadísticas
					$data['profile_content'] = $this->load->view('simple_danger', array('heading' => '¡Lo sentimos!', 'message' => 'Por el momento esta sección no se encuentra implementada.'), TRUE);;
					break;
				default:
					//TODO: Mensaje de error, esto no debería pasar
					$data['profile_content'] = $this->load->view('about', NULL, TRUE);
			}
			$this->load->view('profile',$data);
		}
		$this->load->view('footer');
	}
	
	public function user_publications($id_user = 0){
		checkPermission(1);
		$header_data = array('title' => 'Ver Publicaciones');
		$this->load->view('header_general', $header_data);
		$this->load->view('navbar');
		//echo anchor('main_controller/user_publications/'.$profile_data["username"],'Ver Publicaciones.');
		//TODO: Cargar publicaciones del usuario, pasarlas a la vista. Si el usuario no existe mostrar algo.
		$this->load->view('footer');
	}
	
	public function my_events(){
		checkPermission(1);
		$header_data = array('title' => 'Mis Eventos');
		$this->load->view('header_general',$header_data);
		$this->load->view('navbar');
		//TODO: Cargar Eventos del usuario actual, pasarlos a la vista de eventos.
		$this->load->view('my_events',$this->logging->getEvents($_SESSION["username"]));
		$this->load->view('footer');
	}
	
	public function view_event($id_event = 0){
		checkPermission(1);
		$header_data = array('title' => 'Ver Evento');
		$this->load->view('header_general',$header_data);
		$this->load->view('navbar');
		//TODO: Visualizar la información del evento $id_event
		if($data_event = $this->logging->getEvent($id_event)){
			$this->load->view('view_event', array('event' => $data_event));
		}
		else{
			$this->load->view('simple_danger', array('heading' => '¡El evento solicitado no existe!', 'message' => ''));
		}	
		$this->load->view('footer');
	}
	
	public function view_new($id_new = 0){
		checkPermission(0);
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
	
	public function close(){
		checkPermission(3);
		$header_data = array('title' => 'Denegar Acceso');
		$this->load->view('header_general',$header_data);
		$this->load->view('navbar');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('cause', 'Razón', 'required');
		$this->form_validation->set_rules('description', 'Descripción', 'required');
		$this->form_validation->set_rules('datefrom', 'Fecha cierre', 'required');
		$this->form_validation->set_rules('dateuntil', 'Fecha re-apertura', 'required');
		if($this->form_validation->run()){
			$date_pattern = '[\d{4}-(0[1-9]|1[0-2])-(0[1-9]|1[0-9]|2[0-9]|3(0|1))]';
			if($valid_datefrom = preg_match($this->input->post('datefrom'),$date_pattern)){
				
				debug_var('dateok!');
			}
			if($valid_datefrom = checkdate()){
				
			}
		}
		else{
			//$this->load->view('simple_danger', array('heading' => 'Error en el formulario','message' => 'Revisa los datos e inténtalo de nuevo'));
			$this->load->view('close_platform');
		}
		
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
				$data['link1'] =  anchor("main_controller/user_register","Haz click aquí"). 'para crear una cuenta.';
				break;
			case 2:
				$data['title'] = '¡Oops! La página solicitada no está disponible para ti pues te encuentras baneado.';
				$data['link1'] =  anchor("main_controller/contact","Haz click aquí"). 'para contactar a los administradores y solucionar tu situación.';
				break;
			case 3:
				$data['title'] = '¡Oops! La página a la que estás intentando acceder requiere permisos de administrador.';
				$data['link1'] =  anchor("main_controller/user_login","Haz click aquí"). 'para acceder utilizando tu cuenta.';
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