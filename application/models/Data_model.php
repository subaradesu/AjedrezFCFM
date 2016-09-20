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
		return $this->getEventNotifications($id_user);
	}
	
	/* Cierra el evento $id_event, retorna false si falla o $id_user no es el publicador del evento*/
	public function closeEvent($id_event, $id_user){
		if(count($this->db->query("SELECT * FROM userPublication AS up, event WHERE event.status='ended' AND up.id_publication = event.id_event AND up.id_user='".$id_user."' AND up.id_publication = '".$id_event."';"))){
			return $this->db->simple_query("UPDATE event SET status='closed' WHERE id_event='".$id_event."';");
		}
		return false;
	}
	
	/* Envía el mensaje de emisor al receptor*/
	public function send_message($sender, $receiver, $content){
		//TODO: usar esto pa mandar mensajes entre usuarios
		return $this->db->simple_query("INSERT INTO privateMessage VALUES (null, 'holahola', 'user01', 'user02');");
	}
	
	/* Publica la imagen en el evento*/
	public function addEventPicture($id_publisher, $id_event, $title, $imageFormat){
		
		//si el usuario no confirmó asistencia al evento
		$sql = "SELECT * FROM invitedList WHERE assistance = 'confirmed' AND id_event='".$id_event."' AND id_user='".$id_publisher."';";
		if(count($this->db->query($sql)->result_array()) < 1){
			return false;
		}
		
		//comenzar la transacción
		$this->db->trans_start();
		//Creo una nueva publicacion
		$this->db->query(	"INSERT INTO publication VALUES (null, NOW());");
		
		//guardo la ID en $id
		$id = $this->db->insert_id();
		
		$filename= $id.'.'.$imageFormat;
		
		//guardo la ID en @publication_id
		$this->db->query("	SELECT LAST_INSERT_ID()
							INTO @publication_id;");
		
		//inserto la relación publicación-publicador en la tabla correspondiente
		$this->db->query("	INSERT INTO userPublication
							VALUES ('".$id_publisher."', @publication_id, NOW());");
		//inserto la foto del evento con la id de publicación obtenida
		$this->db->query("	INSERT INTO eventPicture (id_eventPicture, id_event, id_user, title, image_filename)
							VALUES (@publication_id, '".$id_event."', '".$id_publisher."', '".$title."', '".$filename."');");
		//termina la transacción
		$this->db->trans_complete();
		
		return $this->db->trans_status() ? $filename : false ;
	}
	
	//obtiene el puntaje de la publicación
	public function getPublicationScore($id_publication){
		return $this->db->query("SELECT COALESCE(SUM(value), 0) as score FROM `publicationKarma` WHERE id_publication = '".$id_publication."'")->result_array()[0]["score"];
	}
	
	//obtiene el puntaje asignado por el usuario a la publicación
	public function getUserPublicationVote($id_publication, $id_user){
		return $this->db->query("SELECT COALESCE(SUM(value), 0) as score FROM `publicationKarma` WHERE id_user='".$id_user."' AND id_publication = '".$id_publication."'")->result_array()[0]["score"];
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
		$result["games"] = $this->db->query("SELECT * FROM matchboard, userPublication WHERE userPublication.id_user='".$id_user."' AND userPublication.id_publication=matchboard.id_matchboard;")->result_array();
		//$result["comments"] = $this->db->query("SELECT * FROM comment, userPublication WHERE userPublication.id_user='".$id_user."' AND userPublication.id_publication=news.id_new;")->result_array();
		return $result;
	}
	
	/*Borra la publicación $id_publication*/
	function deletePublication($id_publication){
		return $this->db->simple_query("DELETE FROM publication WHERE idPublication='".$id_publication."';");
	}
	
	/*Crea un evento con los datos recibidos*/
	function createEvent($publisher, $title, $start, $end, $location, $description, $visibility, $invited_list, $category){
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
		$this->db->query("	INSERT INTO event (id_event, title, description, date_start, date_end, place, visibility, idCategory)
							VALUES (@publication_id, '".$title."', '".$description."', '".$start."', '".$end."', '".$location."', '".$visibility."', '".$category."');");
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
	
	/*crea la partida en la base de datos*/
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
		$this->db->query(	"INSERT INTO publication
							VALUES (null, NOW());");
		//guardo la ID en $id
		$id = $this->db->insert_id();
		$this->db->query("	SELECT LAST_INSERT_ID()
							INTO @publication_id;");
		//inserto la relación publicación-publicador en la tabla correspondiente
		$this->db->query("	INSERT INTO userPublication (id_user, id_publication, last_changed)
							VALUES ('".$publisher."', @publication_id, NOW());");
		//inserto el matchboard
		$this->db->query("INSERT INTO matchboard (id_matchboard,
											title,
											white_player,
											black_player,
											match_origin,
											details,
											format,
											pgn_board,
											pgn_string)
						VALUES (@publication_id,?,?,?,?,?,?,?,?);", $game_attr);
			
		//termina la transacción
		$this->db->trans_complete();
		return array("status" => $this->db->trans_status(), "id" => $id);
	}
	
	//busca al usuario en la base de datos
	function searchUser($search_term, $search_category){
		$sql = $sql = "	SELECT username, first_name, last_name
						FROM user
						WHERE ".$search_category." LIKE '%".$search_term."%'
						ORDER BY user.".$search_category." ASC";;
		return $this->db->query($sql)->result_array();
	}
	
	//obtiene la información del usuario, distinta info basad en el parámetro info (las funciones de admin sacan más)
	function getUsers($info = 'basic'){
		if($info == 'admin'){
			return $this->db->query("SELECT username, first_name, last_name, email, userStatus FROM user ORDER BY user.username ASC")->result_array();
		}
		return $this->db->query("SELECT username,first_name, last_name FROM user;")->result_array();
	}
	
	//obitne la información del usuario a partir de su id
	function getUserInfo($id_user){
		$r = $this->db->query("SELECT username,first_name, last_name,userStatus FROM user WHERE username='".$id_user."';")->result_array();
		return count($r) > 0 ? $r[0] : false; 
	}
	
	//obtiene la información de la noticia a partir de su id
	function getNew($id_new){
		return $this->db->query("	SELECT *
									FROM news, userPublication AS UP, user
									WHERE id_new='".$id_new."' AND UP.id_publication = id_new AND user.username = UP.id_user
				;")->first_row('array');
	}
	
	//obtiene la informacion de la partida a través de su id
	function getBoardgame($idBoard){
		$info = $this->db->query("SELECT * FROM matchboard WHERE id_matchboard=".$idBoard."")->first_row('array');
		$user = $this->db->query("SELECT id_user FROM userPublication WHERE id_publication=".$idBoard."")->first_row('array');
		$info["user"] = $this->db->query("SELECT username, first_name, last_name FROM user WHERE username='".$user["id_user"]."'")->first_row('array');
		return $info;
	}
	
	//obtiene los comentarios en la publicación $id_publication
	function getComments($id_publication){
		return $this->db->query("SELECT * FROM comment, userPublication WHERE commented_publication='".$id_publication."' AND id_publication=id_comment;")->result_array();
	}

	//retorna todas las noticias existentes
	function getNews(){
		return $this->db->query("SELECT * FROM news;")->result_array();
	}
	
	//retorna todas las partidas existentes
	function getMatchboards(){
		$array = $this->db->query("SELECT * FROM matchboard;")->result_array();
		$array["categories"] = $this->db->query("SELECT matchboard.match_origin, COUNT(matchboard.id_matchboard) AS quantity FROM matchboard GROUP BY matchboard.match_origin ORDER BY matchboard.match_origin;")->result_array();
		return $array;
	}
	function getMatchboardsByOrigin($origin = -1){
		if($origin!=-1){
			$array = $this->db->query("SELECT * FROM matchboard WHERE matchboard.match_origin =".$origin.";")->result_array();
			$array["categories"] = $this->db->query("SELECT matchboard.match_origin, COUNT(matchboard.id_matchboard) AS quantity FROM matchboard GROUP BY matchboard.match_origin ORDER BY matchboard.match_origin;")->result_array();
			$array["selected"] = $origin;
			return $array;
		}
		else
			return $this->db->query("SELECT * FROM matchboard;")->result_array();
	}
	//actualiza el perfil del usuario con los parámetros ingresados
	function updateProfileData($id_user, $update_data){
		if($update_data == null){
			return false;
		}
		$where = "user.username='".$id_user."'";
		$sql = $this->db->update_string('user',$update_data,$where);
		return $this->db->simple_query($sql);
	}

	//actualiza los estados en la base de datos
	function updateDB(){
		//actualiza los estados de los eventos (si el evento ya pasó cambia su estado a 'closed'
		$now = date_create()->format('Y-m-d H:i:s');
		$this->db->trans_start();
		$s = $this->db->query("SELECT * FROM event WHERE date_end<'".$now."';")->result_array();
		foreach ($s as $event){
			$this->db->query("UPDATE event SET status='ended' WHERE id_event='".$event["id_event"]."';");
		}
		//TODO: desbanear si ha pasado el tiempo de baneo.
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	//retorna los datos del perfil del usuario id_user si existe, si no retorna false.
	function getProfileData($id_user){
		$sql ="	SELECT username, first_name, last_name, sex, avatar, userStatus, email
				FROM user
				WHERE username = '".$id_user."'";
		$result = $this->db->query($sql);
		return $result->num_rows() == 1? $result->first_row('array') : false;
	}
	
	//cambia el estado del usuario, Se usa para el baneo y desbaneo de usuarios
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
	
	function modifyAssistance($id_event, $id_user, $assistance){
		
		if(count($event = $this->db->query("SELECT * FROM event WHERE id_event='".$id_event."';")->result_array()) > 0){
			//public event
			$event = $event[0];
			
			if($event["visibility"] == 'public'){
				
				//Si el usuario ya confirmó asistencia edito la entrada
				if(count($this->db->query("SELECT * FROM invitedList WHERE id_event='".$id_event."' AND id_user='".$id_user."';")->result_array())){
					return $this->db->simple_query("UPDATE invitedList SET assistance='".$assistance."' WHERE  id_event='".$id_event."' AND id_user='".$id_user."';");
				}
				//si no ha confirmado asistencia agrego la entrada
				else{
					
					return $this->db->simple_query("INSERT INTO invitedList VALUES ('".$id_event."', '".$id_user."', '".$assistance."', '0');");
				}
			}
			//private event
			else{
				//Si el usuario está invitado al evento
				if($this->db->query("SELECT * FROM invitedList WHERE id_event='".$id_event."' AND id_user='".$id_user."';")){
					return $this->db->simple_query("UPDATE invitedList SET assistance='".$assistance."' WHERE  id_event='".$id_event."' AND id_user='".$id_user."';");
				}
				//si no está invitado
				else{	
					return false;
				}
			}
		}
		//el evento no existe
		return false;
	}
	
	//retorna un arreglo con los asistentes al evento, en 0 los que asisten, en 1 los que no
	function getAssistance($id_event){
		$r = $this->db->query("SELECT assistance, COALESCE(COUNT(assistance),0) AS number FROM invitedList WHERE id_event='".$id_event."' GROUP BY assistance")->result_array();
		
		$result["confirmed"] = 0;
		$result["unconfirmed"] = 0;
		foreach($r as $group){
			if($group["assistance"] == "confirmed"){
				$result["confirmed"] = $group["number"];
			}
			if($group["assistance"] == "unconfirmed"){
				$result["unconfirmed"] = $group["number"];
			}
		}
		return $result;
	}
	
	//retorna la información del evento si es que existe, si no retorna false
	function getEvent($id_event, $user_list = false){
		$r["event_data"] = $this->db->query("SELECT * FROM event WHERE id_event='".$id_event."';")->result_array();
		if(count($r["event_data"]) < 1){
			return false;
		}
		$r["event_data"] = $r["event_data"][0];
		$r["comment_number"] = $this->countComments($id_event);
		$r["assistance"] = $this->getAssistance($id_event);
		if($user_list){
			$r["user_list"] = $this->db->query("SELECT id_event, id_user, assistance, first_name, last_name FROM invitedList, user WHERE username = id_user AND id_event='".$id_event."';")->result_array();
		}
		$cat_id = $r["event_data"]["idCategory"];
		$r["event_data"]["category_name"] = $this->db->query("SELECT category_name FROM Category WHERE idCategory='".$cat_id."';")->result_array()["0"]["category_name"];
		return $r;
	}
	
	//obtiene los eventos del usuario, si $queryType es invited retorna los eventos a los que el usuario fue invitado, si no, obtiene los eventos publicados por el usuario
	function getEvents($id_user, $queryType = 'invited'){
		if ($queryType == 'invited'){
			$result['private_events'] = $this->db->query("SELECT event.id_event AS id_event, title, description, date_start, date_end, place, status, idCategory FROM invitedList AS il, event WHERE event.visibility='private' AND il.id_user='".$id_user."' AND il.id_event=event.id_event;")->result_array();
			$result['public_events'] = $this->db->query("SELECT event.id_event AS id_event, title, description, date_start, date_end, place, status, idCategory FROM event WHERE event.visibility='public';")->result_array();
			$array; 
			foreach($result['private_events'] as $r){
				$array[] = $this->getEvent($r["id_event"]);
			}
			foreach($result['public_events'] as $r){
				$array[] = $this->getEvent($r["id_event"]);
			}
			$array["categories"] = $this->db->query("SELECT ALL Category.idCategory, Category.category_name, COUNT(e1.id_event) AS quantity FROM Category, (SELECT DISTINCT event.id_event, idCategory FROM event, invitedList AS il WHERE event.visibility='public' OR (event.id_event=il.id_event AND il.id_user='".$id_user."')) AS e1 WHERE Category.idCategory = e1.idCategory GROUP BY Category.category_name ORDER BY Category.idCategory;")->result_array();
			return $array;
			//return array_merge($result['private_events'], $result['public_events']);
		}
		return $this->db->query("SELECT event.id_event AS id_event, title, description, date_start, date_end, place, status FROM userPublication AS up, event WHERE up.id_publication=event.id_event AND up.id_user='".$id_user."';")->result_array();
	}
	//obtiene los eventos que son visibles para el usuario, según categoría
	function getEventsByCategory($id_user, $idCategory = 0){
		if ($idCategory != 0){
			$result['private_events'] = $this->db->query("SELECT event.id_event AS id_event, title, description, date_start, date_end, place, status, idCategory FROM invitedList AS il, event WHERE event.visibility='private' AND il.id_user='".$id_user."' AND il.id_event=event.id_event AND event.idCategory='".$idCategory."';")->result_array();
			$result['public_events'] = $this->db->query("SELECT event.id_event AS id_event, title, description, date_start, date_end, place, status, idCategory FROM event WHERE event.visibility='public' AND event.idCategory='".$idCategory."';")->result_array();
			$array; 
			foreach($result['private_events'] as $r){
				$array[] = $this->getEvent($r["id_event"]);
			}
			foreach($result['public_events'] as $r){
				$array[] = $this->getEvent($r["id_event"]);
			}
			$array["categories"] = $this->db->query("SELECT ALL Category.idCategory, Category.category_name, COUNT(e1.id_event) AS quantity FROM Category, (SELECT DISTINCT event.id_event, idCategory FROM event, invitedList AS il WHERE event.visibility='public' OR (event.id_event=il.id_event AND il.id_user='".$id_user."')) AS e1 WHERE Category.idCategory = e1.idCategory GROUP BY Category.category_name ORDER BY Category.idCategory;")->result_array();
			$array["selected"] = $idCategory;
			return $array;
			//return array_merge($result['private_events'], $result['public_events']);
		}
		return $this->db->query("SELECT event.id_event AS id_event, title, description, date_start, date_end, place, status FROM userPublication AS up, event WHERE up.id_publication=event.id_event AND up.id_user='".$id_user."';")->result_array();
	}

	//retorna el total de comentarios en la publicación $id_publication
	function countComments($id_publication){
		$r = $this->db->query("SELECT * FROM comment WHERE commented_publication='".$id_publication."';")->result_array();
		$count = count($r);
		foreach ($r as $comment){
			$count += $this->countComments($comment["id_comment"]);
		}
		return $count;
	}
	
	function getEventImages($id_event){
		return $this->db->query("SELECT * FROM eventPicture, user, publication WHERE idPublication=id_eventPicture AND username=id_user AND id_event='".$id_event."'")->result_array();
	}
	
	//Se encarga de logear al usuario, retorna true si el login es posible, false si no
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
	
	//Realiza la operación de registrar un usuario con los datos solicitados
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
	
	// obtiene las últimas transacciones realizadas basándose en los parámetros recibidos
	function getLastTransactions($transactionType, $autorFilter, $maxResults){
		$sql;
		switch($transactionType){
			case 'comment':
				$sql = "SELECT id_comment, id_user, publicationDate, commented_publication, content
						FROM comment, publication, userPublication
						WHERE comment.id_comment = publication.idPublication AND idPublication = id_publication
						ORDER BY publicationDate DESC
						LIMIT ".$maxResults.";";
				break;
			case 'news':
				$sql = "SELECT id_new, id_user, publicationDate, title
						FROM news, publication, userPublication
						WHERE news.id_new = publication.idPublication AND idPublication = id_publication
						ORDER BY publicationDate DESC
						LIMIT ".$maxResults.";";
				break;
			case 'event':
				$sql = "SELECT id_event, id_user, publicationDate, visibility, status, title
						FROM event, publication, userPublication
						WHERE event.id_event = publication.idPublication AND idPublication = id_publication
						ORDER BY publicationDate 	DESC
						LIMIT ".$maxResults.";";
				break;
			case 'matchboard':
				$sql = "SELECT id_event, id_user, publicationDate, visibility, status
						FROM event, publication, userPublication
						WHERE event.id_event = publication.idPublication AND idPublication = id_publication
						ORDER BY publicationDate 	DESC
						LIMIT ".$maxResults.";";
				break;
			default:
				$sql = "";
		}
		return $this->db->query($sql)->result_array();
	}
	
}
?>