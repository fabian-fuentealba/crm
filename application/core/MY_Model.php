<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {

	var $id_sitio = 1;

	public function __construct(){

		parent::__construct();
		$this->id_sitio = 1;
		$this->db->simple_query(" SET time_zone = 'America/Santiago'; ");	
		$this->db->simple_query(" SET lc_messages = 'es_ES'; ");
	}

	public function message($number,$message){

		switch($number){
			case 0 : $msg = TRUE;
			break;
			default : $msg = $number . ' ' . $message;
			break;
		}

		return $msg;
	}
}