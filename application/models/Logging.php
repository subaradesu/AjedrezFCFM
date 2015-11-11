<?php
Class logging extends CI_model{
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	function createNew($publisher, $title, $content, $image, $category){
		//comenzar transacción
		$this->db->trans_start();
		//Creo una nueva publicacion
		$this->db->query(	"INSERT INTO publication
							VALUES (null);");
		//guardo la ID en @publication_id
		$this->db->query("	SELECT LAST_INSERT_ID()
							INTO @publication_id;");
		//inserto la relación publicación-publicador en la tabla correspondiente
		$this->db->query("	INSERT INTO userPublication (user_username, publication_idPublication)
							VALUES ('".$publisher."', @publication_id);");
		//inserto la noticia con la id de publicación obtenida
		$this->db->query("	INSERT INTO news (idNew, title, date, content, image_url, category)
							VALUES (@publication_id, '".$title."', NOW(), '".$content."', '".$image."', '".$category."');");
		//termina la transacción
		$this->db->trans_complete();
		
		return $this->db->trans_status();
	}
	
	function createEvent($publisher, $title, $date, $location, $time, $description, $visibility, $invited_list){
		//comenzar transacción
		$this->db->trans_start();
		//Creo una nueva publicacion
		$this->db->query(	"INSERT INTO publication
							VALUES (null);");
		//guardo la ID en @publication_id
		$this->db->query("	SELECT LAST_INSERT_ID()
							INTO @publication_id;");
		//inserto la relación publicación-publicador en la tabla correspondiente
		$this->db->query("	INSERT INTO userPublication (user_username, publication_idPublication)
							VALUES ('".$publisher."', @publication_id);");
		//inserto el evento con la id de publicación obtenida
		$this->db->query("	INSERT INTO event (publication_idPublication, title, description, date, time, place, visibility)
							VALUES (@publication_id, '".$title."', '".$description."', '".$date."', '".$time."', '".$location."', '".$visibility."');");
		//creo la invitacion al evento para cada usuario invitado
		if($visibility == 'private'){
			foreach ($invited_list as $invited_user ){
				$this->db->query("	INSERT INTO invitedList
									VALUES (@publication_id,'".$invited_user."','Por Confirmar.','1');");
			}
		}
		//termina la transacción
		$this->db->trans_complete();
		
		return $this->db->trans_status();
	}

	
	function getProfileData($id_user){
		//retorno los datos del perfil del usuario id_user si existe, si no retorno 0.
		$sql ="	SELECT username, first_name, last_name, sex, avatar, userStatus
				FROM user
				WHERE username = '".$id_user."'";
		
		$result = $this->db->query($sql);

		return $result->num_rows() == 1? $result->first_row('array') : 0;
	}
	
	function searchUser($search_term, $search_category){
		$sql = $sql = "	SELECT username, first_name, last_name
						FROM user
						WHERE ".$search_category." LIKE '%".$search_term."%'
						ORDER BY user.".$search_category." ASC";;
		return $this->db->query($sql)->result_array();
	}
	
	function getUsers(){
		return $this->db->query("SELECT username,first_name, last_name FROM user;")->result_array();
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