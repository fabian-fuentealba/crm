<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacts extends Logged {

	public function __construct(){

		parent::__construct();			
		$this->load->library('form_validation');
		$this->load->model(array('Contactos'));

	}

	public function index(){

		if(!in_array($this->session->userdata("id_rol"),array(1,3,4))){
			show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
		}

		$data['contactos'] = $this->Contactos->select();
		$this->load->view('contactos/index',$data);
	}

	public function show(){

		$this->output->unset_template();
		if(!in_array($this->session->userdata("id_rol"),array(1,3,4))){
				show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
		}

		if(!is_numeric($this->uri->segment(3))){
				show_error('Los parametros seleccionados no son validos', 500 , $heading = 'Error 500');
		}

		$where = array(
				'id_contacto' => $this->uri->segment(3)
		);

		$data['contacto'] = $this->Contactos->select( $where , TRUE );
		$this->load->view('contactos/show',$data);
	}
}