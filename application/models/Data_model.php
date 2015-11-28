<?php
Class data_model extends CI_model{
	/*Modelo para acceder de manera uniforme a la base de datos.*/
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	/*Crea una nueva noticia con los datos entregados, retorna el nombre con el que se guardó la imagen en la db, si falla retorna false,*/
	function createNew($publisher, $title, $content, $imageType, $category){
		//comenzar transacción
		$this->db->trans_start();
		//Creo una nueva publicacion
		$this->db->query(	"INSERT INTO publication
							VALUES (null, NOW());");
		$imageFilename = $this->db->insert_id().'.'.$imageType;
	
		//guardo la ID en @publication_id
		$this->db->query("	SELECT LAST_INSERT_ID()
							INTO @publication_id;");
		//inserto la relación publicación-publicador en la tabla correspondiente
		$this->db->query("	INSERT INTO userPublication
							VALUES ('".$publisher."', @publication_id, NOW());");
		//inserto la noticia con la id de publicación obtenida
		$this->db->query("	INSERT INTO news (id_new, title, date, content, image_cover, category)
							VALUES (@publication_id, '".$title."', NOW(), '".$content."', '".$imageFilename."', '".$category."');");
		//termina la transacción
		$this->db->trans_complete();
	
		return $this->db->trans_status() ? $imageFilename : false;
	}
	
	/*Agrega el comentario del usuario en la publicación*/
	function createComment($id_publisher, $id_publication,$content){
		//comenzar transacción
		$this->db->trans_start();
		//Creo una nueva publicacion
		$this->db->query(	"INSERT INTO publication VALUES (null, NOW());");
		
		//guardo la ID en @publication_id
		$this->db->query("	SELECT LAST_INSERT_ID()
							INTO @publication_id;");
		
		//inserto la relación publicación-publicador en la tabla correspondiente
		$this->db->query("	INSERT INTO userPublication
							VALUES ('".$id_publisher."', @publication_id, NOW());");
		//inserto la noticia con la id de publicación obtenida
		$this->db->query("	INSERT INTO comment 
							VALUES (@publication_id, '".$id_publication."', '".$content."');");
		//termina la transacción
		$this->db->trans_complete();
		
		return $this->db->trans_status();
	}
	
	/* Retorna el número de eventos finalizados del usuario que se pueden finalizar (status = ended)*/
	public function getEventNotifications($id_user){
		return $this->db->query("SELECT COALESCE(COUNT(id_event),0) as numberOfEvents FROM event, userPublication WHERE id_event = id_publication AND id_user='".$id_user."' AND status='ended';")->result_array()[0]["numberOfEvents"];
	}
	
	/* Retorna las notificaciones del usuario*/
	public function getUserNotifications($id_user){
		return 2;
	}
	
	
	public function send_message($sender, $receiver, $content){
		//TODO: usar esto pa mandar mensajes entre usuarios
		return $this->db->simple_query("INSERT INTO privateMessage VALUES (null, 'holahola', 'user01', 'user02');");
	}
	
	public function addEventPicture($id_publisher, $id_event, $title = '', $description = '', $image){
		
		//si el usuario no confirmó asistencia al evento
		if(count($this->db->query("SELECT * FROM invitedList WHERE assistance != 'confirmed' AND id_event='".$id_event."' AND id_publisher='".$id_publisher."';")->result_array()) < 1)
			return false;
		
		//comenzar la transacción
		$this->db->trans_start();
		//Creo una nueva publicacion
		$this->db->query(	"INSERT INTO publication VALUES (null, NOW());");
		
		//guardo la ID en @publication_id
		$this->db->query("	SELECT LAST_INSERT_ID()
							INTO @publication_id;");
		
		//inserto la relación publicación-publicador en la tabla correspondiente
		$this->db->query("	INSERT INTO userPublication
							VALUES ('".$id_publisher."', @publication_id, NOW());");
		//inserto la foto del evento con la id de publicación obtenida
		$this->db->query("	INSERT INTO eventPicture
							VALUES (@publication_id, '".$id_event."', '".$id_publisher."', '".$title."', '".$description."', '".$image."');");
		//termina la transacción
		$this->db->trans_complete();
		
		return $this->db->trans_status();
	}
	
	//obtiene el puntaje de la publicación
	public function getPublicationScore($id_publication){
		return $this->db->query("SELECT COALESCE(SUM(value), 0) as score FROM `publicationkarma` WHERE id_publication = '".$id_publication."'")->result_array()[0]["score"];
	}
	
	//obtiene el puntaje asignado por el usuario a la publicación
	public function getUserPublicationVote($id_publication, $id_user){
		return $this->db->query("SELECT COALESCE(SUM(value), 0) as score FROM `publicationkarma` WHERE id_user='".$id_user."' AND id_publication = '".$id_publication."'")->result_array()[0]["score"];
	}
	
	/*Actualiza el puntaje asignado por el usuario a la publicación*/
	public function updateScore($id_user, $id_publication, $value){
		$this->db->trans_start();
		if($this->db->query("SELECT * FROM publicationKarma WHERE id_publication = '".$id_publication."' AND id_user = '".$id_user."';")->num_rows()){
			$this->db->simple_query("UPDATE publicationKarma SET value='".$value."' WHERE id_publication = '".$id_publication."' AND id_user = '".$id_user."';");
		}
		else{
			$this->db->simple_query("INSERT INTO publicationKarma VALUES ('".$id_publication."','".$id_user."','".$value."');");
		}
		$this->db->trans_complete();
		return $this->db->trans_status();		
	}
	
	//obtiene las publicaciones del usuario
	function getPublications($id_user){
		$result["events"] = $this->db->query("SELECT * FROM event, userPublication WHERE userPublication.id_user='".$id_user."' AND userPublication.id_publication=event.id_event;")->result_array();
		$result["news"] = $this->db->query("SELECT * FROM news, userPublication WHERE userPublication.id_user='".$id_user."' AND userPublication.id_publication=news.id_new;")->result_array();
		//$result["games"] = $this->db->query();
		$result["comments"] = $this->db->query("SELECT * FROM ");
		return $result;
	}
	
	function deletePublication($id_publication){
		return $this->db->simple_query("DELETE FROM publication WHERE idPublication='".$id_publication."';");
	}
	
	function createEvent($publisher, $title, $start, $end, $location, $description, $visibility, $invited_list){
		//comenzar transacción
		$this->db->trans_start();
		//Creo una nueva publicacion
		$this->db->query(	"INSERT INTO publication
							VALUES (null, NOW());");
		//guardo la ID en @publication_id
		$this->db->query("	SELECT LAST_INSERT_ID()
							INTO @publication_id;");
		//inserto la relación publicación-publicador en la tabla correspondiente
		$this->db->query("	INSERT INTO userPublication (id_user, id_publication, last_changed)
							VALUES ('".$publisher."', @publication_id, NOW());");
		//inserto el evento con la id de publicación obtenida
		$this->db->query("	INSERT INTO event (id_event, title, description, date_start, date_end, place, visibility)
							VALUES (@publication_id, '".$title."', '".$description."', '".$start."', '".$end."', '".$location."', '".$visibility."');");
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
		$game_attr = array(
				$this->db->escape_str($title),
				$this->db->escape_str($white),
				$this->db->escape_str($black),
				$this->db->escape_str($origin),
				$this->db->escape_str($content),
				$this->db->escape_str($format),
				$this->db->escape_str($filename),
				$this->db->escape_str($stringpgn));
		$this->db->trans_start();
		//Creo una nueva publicacion
		$this->db->query("INSERT INTO matchboard (title,
											white_player,
											black_player,
											match_origin,
											details,
											format,
											pgn_board,
											pgn_string)
						VALUES (?,?,?,?,?,?,?,?);", $game_attr);
		$id = $this->db->insert_id();
		$this->db->query("SELECT LAST_INSERT_ID() INTO @mboard_id;");	
		$this->db->query("INSERT INTO uploadsMatch (user_id, matchboard_id) VALUES (?, @mboard_id);", $publisher);		
		//termina la transacción
		$this->db->trans_complete();
		return array("status" => $this->db->trans_status(), "id" => $id);
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
	
	function getUserInfo($id_user){
		$r = $this->db->query("SELECT username,first_name, last_name,userStatus FROM user WHERE username='".$id_user."';")->result_array();
		return count($r) > 0 ? $r[0] : false; 
	}
	
	function getNew($id_new){
		return $this->db->query("SELECT * FROM news WHERE id_new='".$id_new."'")->first_row('array');
	}
	
	function getBoardgame($idBoard){
		$info =$this->db->query("SELECT * FROM matchboard WHERE matchboard_id=".$idBoard."")->first_row('array');
		$user = $this->db->query("SELECT user_id FROM uploadsMatch WHERE matchboard_id=".$idBoard."")->first_row('array');
		$info["user"] = $this->db->query("SELECT first_name, last_name FROM user WHERE username='".$user["user_id"]."'")->first_row('array');
		return $info;
	}
	
	function getComments($id_publication){
		return $this->db->query("SELECT * FROM comment, userPublication WHERE commented_publication='".$id_publication."' AND id_publication=id_comment;")->result_array();
	}

	function getNews(){
		return $this->db->query("SELECT * FROM news;")->result_array();
	}
	function getMatchboards(){
		return $this->db->query("SELECT * FROM matchboard;")->result_array();
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
	
	function getOptionalProfileData($id_user){
		return $this->db->query("SELECT * FROM user_info WHERE user_id= '".$id_user."';");
	}
	
	function changeStatus($id_user, $new_status, $ban_date=''){
		return $this->db->simple_query("UPDATE user SET userStatus='".$new_status."' WHERE user.username='".$id_user."'");
		$this->db->trans_start();
		//cambio el estado del usuario
		$this->db->simple_query("UPDATE user SET userStatus='".$new_status."' WHERE user.username='".$id_user."'");
		if($new_status == 2){
			if($this->db->query("SELECT * FROM banStatus WHERE id_user='".$id_user."';")->count_all()){
				$this->db->simple_query("INSERT INTO banStatus VALUES ('".$id_user."', '1', ".$ban_date."');");
			}
			else{
				$this->db->simple_query("UPDATE banStatus SET banned=1, ban_until='".$ban_date."' WHERE banStatus.id_user='".$id_user."';");
			}
		}
		elseif($new_status == 1){
			//asumo que está baneado
			$this->db->simple_query("UPDATE banStatus SET banned=0, ban_until=NOW() WHERE banStatus.id_user='".$id_user."';");
		}
		$this->db->trans_complete();
		
		return $this->db->trans_status();
	}
	
	//retorna la información del evento si es que existe, si no retorna false
	function getEvent($id_event){
		$r = $this->db->query("SELECT * FROM event WHERE id_event='".$id_event."';")->result_array();
		return count($r) > 0 ? $r[0] : false;
	}
	
	function getEvents($id_user){
		$result['private_events'] = $this->db->query("SELECT event.id_event AS id_event, title, description, date_start, date_end, place, status FROM invitedList AS il, event WHERE il.id_user='".$id_user."' AND il.id_event=event.id_event AND event.status!='closed';")->result_array();
		$result['public_events'] = $this->db->query("SELECT event.id_event AS id_event, title, description, date_start, date_end, place, status FROM event WHERE event.visibility='public' AND event.status!='closed';")->result_array();
		return array_merge($result['private_events'], $result['public_events']);
	}
	
	function countComments(){
		
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