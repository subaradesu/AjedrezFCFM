<?php
Class logging extends CI_model{
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	function userLogin($username, $password, $currentTries){
		//busco el registro en la base de datos
		$sql ="	SELECT user.username AS username, user.first_name AS first_name, user.last_name AS last_name, user.sex AS sex, user.userStatus AS userStatus, timestamps.update_time AS update_time
				FROM user, timestamps
				WHERE user.username = '".$username."' AND user.password = '".$password."' AND user.username=timestamps.username";
		
		//realizo la query
		$query = $this->db->query($sql);
		
		if($query->num_rows() == 1){
			return $query->first_row();
		}
		else{
			return false;
		}
	}
	
	function userRegister(){
		
	}
	
}
?>