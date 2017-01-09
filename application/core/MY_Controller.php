<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

	var $site = 'sexCITY';
	var $sites = array(
		1 => 'SEXCITY.CL'
	);
	var $page = 'sexcity.cl';

	public function __construct(){

		parent::__construct();
		$this->output->set_template('layout');
		$this->load->css('assets/css/one.css');
		$this->load->css('assets/css/theme.css');
		$this->load->js('assets/js/one.js');
	}
}


class Logged extends MY_Controller{

	public function __construct(){

		parent::__construct();
		if($this->session->userdata("logged_in") != TRUE){
			redirect(site_url('login'));
		}else{

			if($this->session->userdata("id_rol") == 1){
				
				$this->load->section('menu','sections/root');

			}elseif($this->session->userdata("id_rol") == 2){

				$this->load->section('menu','sections/cliente');

			}
			
		}

	}

}