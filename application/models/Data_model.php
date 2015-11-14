<?php
Class data_model extends CI_model{
	/*Modelo para acceder de manera uniforme a la base de datos.*/
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	function createNew($publisher, $title, $content, $imageType, $category){
		//comenzar transacción
		$this->db->trans_start();
		//Creo una nueva publicacion
		$this->db->query(	"INSERT INTO publication
							VALUES (null);");
		$imageFilename = $this->db->insert_id().'.'.$imageType;
	
		//guardo la ID en @publication_id
		$this->db->query("	SELECT LAST_INSERT_ID()
							INTO @publication_id;");
		//inserto la relación publicación-publicador en la tabla correspondiente
		$this->db->query("	INSERT INTO userPublication (user_username, publication_idPublication)
							VALUES ('".$publisher."', @publication_id);");
		//inserto la noticia con la id de publicación obtenida
		$this->db->query("	INSERT INTO news (idNew, title, date, content, image_url, category)
							VALUES (@publication_id, '".$title."', NOW(), '".$content."', '".$imageFilename."', '".$category."');");
		//termina la transacción
		$this->db->trans_complete();
	
		return $this->db->trans_status() ? $imageFilename : 0;
	}
	
	function getPublications($id_user){
		$result["events"] = $this->db->query("SELECT * FROM event, userpublication WHERE userpublication.user_username='".$id_user."' AND userpublication.publication_idPublication=event.publication_idPublication;")->result_array();
		$result["news"] = $this->db->query("SELECT * FROM news, userpublication WHERE userpublication.user_username='".$id_user."' AND userpublication.publication_idPublication=news.idNew;")->result_array();
		//$result["games"] = $this->db->query();
		//$result["comments"] = $this->db->query();
		return $result;
	}
	
	public function deletePublication($id_publication){
		return $this->db->simple_query("DELETE FROM publication WHERE idPublication='".$id_publication."';");
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
	
	function createGame($publisher, $title, $white, $black, $origin, $content, $format, $filename, $stringpgn){
		//comenzar transacción
		$title = $this->db->escape_str($title);
		$game_attr = array(
				$this->db->escape_str($white),
				$this->db->escape_str($black),
				$this->db->escape_str($origin),
				$this->db->escape_str($content),
				$this->db->escape_str($format),
				$this->db->escape_str($filename),
				$this->db->escape_str($stringpgn));
		$this->db->trans_start();
		//Creo una nueva publicacion
		$this->db->query("INSERT INTO matchboard (white_player,
											black_player,
											match_origin,
											details,
											format,
											pgn_board,
											pgn_string)
						VALUES (?,?,?,?,?,?,?);", $game_attr);
		//termina la transacción
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	function searchUser($search_term, $search_category){
		$sql = $sql = "	SELECT username, first_name, last_name
						FROM user
						WHERE ".$search_category." LIKE '%".$search_term."%'
						ORDER BY user.".$search_category." ASC";;
		return $this->db->query($sql)->result_array();
	}
	
	function getUsers($info = 'basic'){
		if($info == 'admin'){
			return $this->db->query("SELECT username, first_name, last_name, email, userStatus FROM user ORDER BY user.username ASC")->result_array();
		}
		return $this->db->query("SELECT username,first_name, last_name FROM user;")->result_array();
	}
	
	function getNew($idNew){
		return $this->db->query("SELECT * FROM news WHERE idNew='".$idNew."'")->first_row('array');
	}
	
	function getBoardgame($idBoard){
		return $this->db->query("SELECT * FROM matchboard WHERE matchboard_id=".$idBoard."")->first_row('array');
	}

	function getNews(){
		return $this->db->query("SELECT * FROM news;")->result_array();
	}
	
	function updateProfileData($id_user, $update_data){
		if($update_data == null){
			return false;
		}
		$where = "user.username='".$id_user."'";
		$sql = $this->db->update_string('user',$update_data,$where);
		return $this->db->simple_query($sql);
	}

	
	function getProfileData($id_user){
		//retorno los datos del perfil del usuario id_user si existe, si no retorno 0.
		$sql ="	SELECT username, first_name, last_name, sex, avatar, userStatus, email
				FROM user
				WHERE username = '".$id_user."'";
		
		$result = $this->db->query($sql);

		return $result->num_rows() == 1? $result->first_row('array') : 0;
	}
	
	function changeStatus($id_user, $new_status){
		return $this->db->simple_query("UPDATE user SET userStatus='".$new_status."' WHERE user.username='".$id_user."'");
	}
	
	function getEvent($id_event){
		return $this->db->query("SELECT * FROM event WHERE publication_idPublication='".$id_event."';")->result_array();
	}
	
	function getEvents($id_user){
		$result['private_events'] = $this->db->query("SELECT * FROM invitedList AS il, event WHERE il.invited_username='".$id_user."' AND il.idevent=event.publication_idPublication")->result_array();
		$result['public_events'] = $this->db->query("SELECT * FROM event WHERE event.visibility='public'")->result_array();
		
		return $result;
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