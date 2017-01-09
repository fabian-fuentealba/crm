<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Parametros extends Logged {

	public function index(){

		$this->load->view("parametros/index");
	}

}