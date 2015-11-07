<?php 

class main_controller extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->helper('html');
		$this->load->helper('url');
	}
	
	public function index(){
		$data = array('title' => 'Inicio');
		$this->load->view('header',$data);
		$this->load->view('navbar');
		$this->load->view('home');
		$this->load->view('footer');
	}
	
	public function contact(){
		$this->load->view('header');
		$this->load->view('navbar');
		$this->load->view('contact');
		$this->load->view('footer');
	}
	
	public function news(){
		$this->load->view('header');
		$this->load->view('navbar');
		$this->load->view('news');
		$this->load->view('footer');
	}
	
	public function about(){
		$this->load->view('header');
		$this->load->view('navbar');
		$this->load->view('about');
		$this->load->view('footer');
	}
	
	public function links(){
		$this->load->view('header');
		$this->load->view('navbar');
		$this->load->view('links');
		$this->load->view('footer');
	}
	
	public function search_user($data = false){
		$this->load->view('header');
		$this->load->view('navbar');
		if(!$data){
			$this->load->view('search_user_panel');
		}
		else{
			
		}
		$this->load->view('footer');
	}
	
	public function publish_new($data = false){
		$this->load->view('header');
		$this->load->view('navbar');
		$this->load->view('create_new');
		$this->load->view('footer');
	}
	
	public function publish_event($data = false){
		$this->load->view('header');
		$this->load->view('navbar');
		$this->load->view('create_event');
		$this->load->view('footer');
	}
	
	public function publish_game($data = false){
		$this->load->view('header');
		$this->load->view('navbar');
		$this->load->view('create_game');
		$this->load->view('footer');
	}
	
	public function user_login(){
		$this->load->view('header');
		$this->load->view('navbar');
		$this->load->view('log_pane');
		$this->load->view('footer');
	}
	
	public function user_logout(){
		redirect('main_controller/index');
	}
	
	public function user_register(){
		$this->load->view('header');
		$this->load->view('navbar');
		$this->load->view('register_pane');
		$this->load->view('footer');
	}
	
	public function user_profile(){
		$this->load->view('header');
		$this->load->view('navbar');
		$this->load->view('footer');
	}
	
	public function user_events(){
		$this->load->view('header');
		$this->load->view('navbar');
		$this->load->view('footer');
	}
	
	
	
}

?>