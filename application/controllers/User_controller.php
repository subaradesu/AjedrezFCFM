<?php
defined('BASEPATH') OR exit('No direct script access allowed');
define("MAX_AVATARSIZE", 1000000); //1MB limit
define("MAX_AVATARWIDTH", 600);
define("MAX_AVATARHEIGHT", 600);

class User_controller extends CI_Controller{

	/*Controlador encargado de las vistas asociadas a los usuarios*/
	
	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('data_model');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('general_helper');
	}
	
	public function user_login(){
		checkPermission(-1);
		$this->load->library('form_validation');
		
		$header_data = array('title' => 'Ingresar', 'css_file_paths' => getCSS('login'));
		
		$this->form_validation->set_rules('user', 'Nombre de Usuario', 'required');
		$this->form_validation->set_rules('pass', 'Contraseña', 'required');
		if($this->form_validation->run()){
			$user = $this-> input ->post('user');
			$pass = $this-> input ->post('pass');
			if($logtry = $this->data_model->userLogin($user, $pass)){
				$this->session->isLogged = 1;
				$this->session->username = $logtry->username;
				$this->session->sex = $logtry->sex;
				$this->session->first_name = $logtry->first_name;
				$this->session->last_name = $logtry->last_name;
				$this->session->permission = $logtry->userStatus;
				$this->session->last_log = $logtry->update_time;
				$this->data_model->updateDB();
				$this->session->notifications = $this->data_model->getUserNotifications($this->session->username);
				$this->session->event_notifications = $this->data_model->getEventNotifications($this->session->username);

				//TODO buscar como hacer variable global $nav_data
// 				$nav_data = array(	'userLogged' => $_SESSION["isLogged"],
// 									'username' => $_SESSION["username"],
// 									'userType' => $_SESSION["permission"],
// 									'first_name' => $_SESSION["first_name"],
// 									'last_name' => $_SESSION["last_name"],
// 									'sex' => $_SESSION["sex"],
// 									'notifications' => $this->data_model->getEventNotifications($this->session->username)
// 				);
				//mensaje de bienvenida, si el usuario está baneado
				if($_SESSION["permission"] == 2){
					$this->load->view('header', $header_data);
					$this->load->view('navbar');
					$this->load->view('simple_danger', array(	'heading' => 'Ingreso Exitoso...',
							'message' => ($this->session->sex == 2 ? 'Bienvenida ' : 'Bienvenido ').$this->session->first_name.' '.$this->session->last_name.'. Tu último ingreso fue hace '.daysSinceLastLogin($this->session->last_log).' días. <p>Al parecer tu cuenta se encuentra baneada, contáctate con los administradores para solucionar tu situación. Por ahora tienes acceso limitado al sitio.</p>'));
				}
				//mensaje de bienvenida normal
				else{
					$header_data['css_file_paths'] = getCSS('index');
					$this->load->view('header', $header_data);
					$this->load->view('navbar');
					$this->load->view('simple_success', array(	'heading' => '¡Ingreso Exitoso!',
							'message' => ($this->session->sex == 2 ? 'Bienvenida ' : 'Bienvenido ').$this->session->first_name.' '.$this->session->last_name.'. Tu último ingreso fue hace '.daysSinceLastLogin($this->session->last_log).' días. Disfruta tu estadía.'));
					$this->load->view('home');
				}
			}
			else{
				$this->load->view('header', $header_data);
				$this->load->view('navbar');
				$this->load->view('simple_danger', array(	'heading' => '¡Nombre de Usuario y/o Contraseña incorrecto!',
						'message' => 'Inténtalo de nuevo'));
				$this->load->view('log_pane');
			}
		}
		else{
			$this->load->view('header', $header_data);
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
		$header_data = array('title' => 'Registro', 'css_file_paths' => getCSS('register'));	
		$this->load->view('header', $header_data);
		
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
				
			if($register = $this->data_model->userRegister($user, $pass, $first_name, $last_name, $email)){
				//agregué al usuario
	
				$this->load->view('simple_success', array(	'heading' => '¡Usuario registrado con éxito!',
						'message' => 'Puedes hacer ingreso al sistema con tu nombre de usuario y contraseña.'));
			}
			else{
				//no pude agregar al usuario
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
		$profile_data = $this->data_model->getProfileData($id_user);
		$header_data = array('title' => 'Ver Perfil - '.$profile_data["first_name"].' '.$profile_data["last_name"], 'css_file_paths' => getCSS('profile'));
	
		//cargo las vistas
		$this->load->view('header', $header_data);
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
					$should_update = 0;
					if(($name = $this->input->post('name')) != null){
						$update_data["first_name"]=$name;
						$should_update = 1;
					}
					if(($lastname = $this->input->post('lastname')) != null){
						$update_data["last_name"]=$lastname;
						$should_update = 1;
					}
					if(($email = $this->input->post('email')) != null){
						$update_data["email"]=$email;
						$should_update = 1;
					}
					if(($sex = $this->input->post('sex')) != null && $sex != $profile_data["sex"]){
						$update_data["sex"]=$sex;
						$should_update = 1;
					}
					if(($password = $this->input->post('password')) != null){
						//TODO: revisar restricciones para la nueva contraseña (?)
						$update_data["password"]=$password;
						$should_update = 1;
					}
					//Si se subió una imagen
					//checkeo a la mala si es una imagen y está subido
					if(isset($_FILES["avatar"]["tmp_name"]) && file_exists($_FILES["avatar"]["tmp_name"])){
						if(!($check = getimagesize($_FILES["avatar"]["tmp_name"]))){
							//no era imagen, mostrar error
							$this->load->view('simple_danger', array('heading' => 'No se pudo subir el archivo', 'message' => 'No era una imagen'));
						}
						elseif ($_FILES["avatar"]["size"] > MAX_AVATARSIZE){
							$this->load->view('simple_danger', array('heading' => 'No se pudo subir el archivo', 'message' => 'No se aceptan archivos de más de 1MB'));
						}
						elseif ($check[0] > MAX_AVATARWIDTH || $check[1] > MAX_AVATARHEIGHT){
							$this->load->view('simple_danger', array('heading' => 'No se pudo subir el archivo', 'message' => 'Las máximas dimensiones soportadas son de 600x600'));
						}
						else{
							$should_update = 1;
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
					if($should_update && $update_data != null){
						if($this->data_model->updateProfileData($id_user, $update_data)){
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
	
	public function admin($action = 'none', $id_user = 0){
		checkPermission(3);
		$header_data = array('title' => 'Administrar', 'css_file_paths' => getCSS('default'));
		$this->load->view('header',$header_data);
		$this->load->view('navbar');
		if($action == 'ban'){
			$this->data_model->changeStatus($id_user, 2);
		}
		elseif($action == 'unban'){
			$this->data_model->changeStatus($id_user, 1);
		}
		//TODO: Cargar vista de administración
		$this->load->view('admin',array('users' => $this->data_model->getUsers('admin')));
		$this->load->view('footer');
	}
	
	public function close(){
		checkPermission(3);
		$header_data = array('title' => 'Denegar Acceso', 'css_file_paths' => getCSS('default'));
		$this->load->view('header',$header_data);
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
	
	public function user_publications($id_user = 0, $id_publication = 0, $action = 'none'){
		checkPermission(3);
		$header_data = array('title' => 'Ver Publicaciones', 'css_file_paths' => getCSS('default'));
		$this->load->view('header', $header_data);
		$this->load->view('navbar');
		//echo anchor('main_controller/user_publications/'.$profile_data["username"],'Ver Publicaciones.');
		//TODO: Cargar publicaciones del usuario, pasarlas a la vista. Si el usuario no existe mostrar algo.
		if($action == 'delete' && $id_publication != 0){
			if ($deleted = $this->data_model->deletePublication($id_publication)){
				$this->load->view('simple_success', array('heading' => 'La publicación fue borrada con éxito', 'message' => ''));
			}
			else{
				dangerView('La publicación no se pudo borrar','');
			}
		}
		$this->load->view('user_publications', $this->data_model->getPublications($id_user));
		$this->load->view('footer');
	}
	
	public function search_user(){
		checkPermission(1);
		//TODO: revisar como hacer la búsqueda con GET
		$this->load->library('form_validation');
		$header_data = array('title' => 'Buscar Usuario', 'css_file_paths' => getCSS('default'));
		$this->load->view('header', $header_data);
		$this->load->view('navbar');
	
		$this->form_validation->set_rules('search', 'Término de Búsqueda', 'required');
		if(!$this->form_validation->run()){
			$this->load->view('search_user_panel');
		}
		else{
			$search_term = $this->input->post('search');
			$search_category = $this->input->post('searchby');
			$search_result = $this->data_model->searchUser($search_term, $search_category);
			$this->load->view('search_results', array('search_result' => $search_result));
		}
		$this->load->view('footer');
	}
	
	public function ban_user($id_user){
		checkPermission(3);
		$this->load->library('form_validation');
		$header_data = array('title' => 'Banear Usuario', 'css_file_paths' => getCSS('default'));
		$this->load->view('header', $header_data);
		$this->load->view('navbar');
		
		$this->form_validation->set_rules('user', 'Nombre de Usuario', 'required');
		$this->form_validation->set_rules('pass', 'Contraseña', 'required');

		if($user_info = $this->data_model->getUserInfo($id_user)[0]){
			//TODO: ver que pasa si no encontré al user
			if($user_info["userStatus"]!=3){
				$this->load->view('ban_user', $user_info);
			}
			else{
				dangerView('El usuario no puede ser baneado!', 'No se pueden banear administradores.');
			}
		}
	
		$this->load->view('footer');
	}
}
?>