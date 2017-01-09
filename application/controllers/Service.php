<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends Logged {

	public function __construct(){

		parent::__construct();			
		$this->load->library('form_validation');
		$this->load->model(array('Usuarios','Parametros','Detalles','Tarifas','Fotos','Planes','Sitios','Contactos','Rel_usuarios_servicio','Rel_usuarios_lugares','Rel_usuarios_sitios'));

	}

	public function index(){

		if(!in_array($this->session->userdata("id_rol"),array(1,3,4))){
			show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
		}

		if(!is_numeric($this->uri->segment(3))){
			show_error('Los parametros seleccionados no son validos', 500 , $heading = 'Error 500');
		}

		if($this->input->server("REQUEST_METHOD") == "POST"){
			$where = array(
				'id_usuario' => $this->uri->segment(3),
			);
			$this->Rel_usuarios_servicio->delete($where);
			foreach ($this->input->post("servicio") as $key => $value) {
				$data_insert = array(
					'id_creador' => $this->session->userdata("id_usuario") ,
					'id_servicio' => $key ,
					'id_usuario' => $this->uri->segment(3) ,
					$value => 1
				);
				$this->Rel_usuarios_servicio->insert($data_insert);
			}
			redirect(site_url(uri_string()));
		}
		
		$data['servicios'] = $this->Rel_usuarios_servicio->select( $this->uri->segment(3) );
		$this->load->view( 'service/index' , $data );

	}

}