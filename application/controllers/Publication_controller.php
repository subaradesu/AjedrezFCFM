<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Publication_controller extends CI_Controller{
	/*Controlador encargado de mostrar las vistas asociadas a las publicaciones*/
	
	
	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('data_model');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('general_helper');
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
				if($image_name = $this->data_model->createNew($_SESSION["username"],$title,$content, $imageType,$category)){
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
			if($publish_try = $this->data_model->createEvent($_SESSION["username"],$title, $date, $location, $time, $description, $visibility, $invited_list)){
				$this->load->view('simple_success', array ('heading' => '¡El evento fue creado con éxito!', 'message' => 'Los usuarios invitados recibirán una notificación'));
			}
			else{
				$this->load->view('simple_danger', array('heading' => 'El evento no pudo ser creado', 'message' => ''));
				$this->load->view('create_event', array('users' => $this->data_model->getUsers()));
			}
		}
		else{
			$this->load->view('create_event', array('users' => $this->data_model->getUsers()));
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
			$error_message="";
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
					$error_message = "Archivo ya existe";
				}
				// Check file size
				if ($_FILES["fileToUpload"]["size"] > 500000) {
					$uploadOk = 0;
					$error_message = "Archivo muy grande";
				}
				// Allow certain file formats
				if($fileType != "pgn") {
					$uploadOk = 0;
					$error_message = "Archivo no tiene extensión PGN";
				}
				
				else{
					if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_fullpath)) {
						$uploadOk = 1;
					}
					else {
						$uploadOk = 0;
						$error_message = "No se pudo guardar archivo";
					}
				}
			}
			else {
				$stringpgn = $this->input->post('textToUpload');
				$uploadOk = 1;
			}
			if($uploadOk == 1){
				$publish_try = $this->data_model->createGame($_SESSION["username"],$title, $white, $black, $origin, $content, $format, $filename, $stringpgn);
				if($publish_try["status"]){
					$this->load->view('simple_success', array ('heading' => '¡La partida fue creada con éxito!', 
						'message' => 'Puedes ver la partida '.anchor('publication_controller/view_boardgame/'.$publish_try["id"], 'aquí', 'title="Boardgame'.$publish_try["id"].'"')));
				//$this->output->set_header('refresh:5;url='.$this->);
				}
				else{// Check if $uploadOk is set to 0 by an error
					$this->load->view('simple_danger', array('heading' => 'La partida no pudo ser creada', 'message' => 'Falló la consulta SQL'));
					$this->load->view('create_game', array('users' => $this->data_model->getUsers()));
				}
			}
			else{// Check if $uploadOk is set to 0 by an error
				$this->load->view('simple_danger', array('heading' => 'La partida no pudo ser creada', 'message' => $error_message));
				$this->load->view('create_game', array('users' => $this->data_model->getUsers()));
			}
		}
		else{
			$this->load->view('create_game', array('users' => $this->data_model->getUsers()));
		}
		//$this->load->view('create_game');
		$this->load->view('footer');
	}
	
	public function view_new($id_new = 0){
		checkPermission(0);
		$header_data = array('title' => 'Ver Evento');
		$this->load->view('header_general',$header_data);
		$this->load->view('navbar');
		//TODO: Visualizar la información de la noticia $id_new
		if($data_new = $this->data_model->getNew($id_new)){
			$this->load->view('view_new', array('data_new' => $data_new));
		}
		else{
			$this->load->view('simple_danger', array('heading' => '¡La noticia solicitada no existe!', 'message' => ''));
		}
		$this->load->view('footer');
	}
	
	public function my_events(){
		checkPermission(1);
		$header_data = array('title' => 'Mis Eventos');
		$this->load->view('header_general',$header_data);
		$this->load->view('navbar');
		//TODO: Cargar Eventos del usuario actual, pasarlos a la vista de eventos.
		$this->load->view('my_events',$this->data_model->getEvents($_SESSION["username"]));
		$this->load->view('footer');
	}
	
	public function view_event($id_event = 0){
		checkPermission(1);
		$header_data = array('title' => 'Ver Evento');
		$this->load->view('header_general',$header_data);
		$this->load->view('navbar');
		//TODO: Visualizar la información del evento $id_event
		if($data_event = $this->data_model->getEvent($id_event)){
			$this->load->view('view_event', array('event' => $data_event));
		}
		else{
			$this->load->view('simple_danger', array('heading' => '¡El evento solicitado no existe!', 'message' => ''));
		}
		$this->load->view('footer');
	}
	

	public function view_boardgame($id_boardgame = 0){
		checkPermission(1);
		$header_data = array('title' => 'Ver Evento');
		$this->load->view('header_general',$header_data);
		$this->load->view('navbar');
		if($data_boardgame = $this->data_model->getBoardgame($id_boardgame)){
			$this->load->view('view_boardgame', array('data_boardgame' => $data_boardgame));
		}
		else{
			$this->load->view('simple_danger', array('heading' => '¡La partida solicitada no existe!', 'message' => ''));
		}
		$this->load->view('footer');
	}
}
?>