<?php
Class logging extends CI_model{
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	function userLogin($username, $password){
		$result;
		//busco el registro en la base de datos
		$sql ="	SELECT user.username AS username, user.first_name AS first_name, user.last_name AS last_name, user.sex AS sex, user.userStatus AS userStatus, timestamps.update_time AS update_time
				FROM user, timestamps
				WHERE user.username = '".$username."' AND user.password = '".$password."' AND user.username=timestamps.username";
		
		//realizo la query
		$query = $this->db->query($sql);
		
		if($query->num_rows() == 1){
			$result = $query->first_row();
			
			//si me logeo actualizo los timestamps
			$sql2= "UPDATE timestamps
					SET create_time=NOW()
					WHERE username='".$result->username."'";
			
			if($this->db->simple_query($sql2)){
				//Todo Ok
			}
			else{
				//Falló por algo.
			}
		}
		else{
			$result = false;
		}
		
		return $result;
	}
	
	function userRegister(){
		
	}
	
}
?>