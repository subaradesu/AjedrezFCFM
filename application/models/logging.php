<?php
Class logging extends CI_model{
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	function getProfileData($id_user){
		//retorno los datos del perfil del usuario id_user si existe, si no retorno 0.
		$sql ="	SELECT username, first_name, last_name, sex, avatar, userStatus
				FROM user
				WHERE username = '".$id_user."'";
		
		$result = $this->db->query($sql);

		return $result->num_rows() == 1? $result->first_row('array') : 0;
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
					SET update_time=NOW()
					WHERE username='".$result->username."';";
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
	
	function userRegister($user, $pass, $first_name, $last_name, $email){
		//comenzar transacción
		$this->db->trans_start();
		//agrega el usuario a la tabla usuario
		$this->db->query(	"INSERT INTO user (username, password, first_name, last_name, email, sex, avatar, userStatus)
							VALUES ('".$user."', '".$pass."', '".$first_name."', '".$last_name. "', '".$email."', '0','defaultAvatar.jpg', '1');");
		//crea la entrada en timestamps del usuario
		$this->db->query("INSERT INTO timestamps
						  VALUES ('".$user."',NOW(),NOW());");
		//termina la transacción
		$this->db->trans_complete();
		
		//falso si falló la transacción.
		return $this -> db -> trans_status();
	}
	
}
?>