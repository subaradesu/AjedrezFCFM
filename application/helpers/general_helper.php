<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function getAvatarPath($avatarFilename){
	return base_url().'img/avatar/'.$avatarFilename;
}

?>