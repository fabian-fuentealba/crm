<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends Logged {

	public function __construct(){

		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model(array('Usuarios','Servicios','Rel_usuarios_servicio'));

	}

	public function index(){
		
		if(!in_array($this->session->userdata("id_rol"),array(1,3,4))){
			show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
		}

		if($this->input->server("REQUEST_METHOD") == "POST"){			
			foreach ($this->input->post("eliminar") as $key => $value) {
				$where = array(
					'id_servicio' => $value
				);
				$this->Servicios->delete($where);
				$this->Servicios->delete($where);
			}
			redirect(site_url(uri_string()));
		}

		$data['servicios'] = $this->Servicios->select();
		$this->load->view('servicios/index',$data);
	}

	public function editar(){
		
		$this->output->unset_template();
		if(!in_array($this->session->userdata("id_rol"),array(1,3,4))){
			show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
		}

		if(!is_numeric($this->uri->segment(3))){
			show_error('Los parametros seleccionados no son validos', 500 , $heading = 'Error 500');
		}

		if(!$this->input->is_ajax_request()){
			show_error('Metodo de acceso invalido.', 401 , $heading = '401 No autorizado');
		}

		$this->form_validation->set_rules('servicio','servicio','trim|strip_tags|required');
		$this->form_validation->set_rules('estado','estado','trim|numeric');

		if($this->form_validation->run()){

			$data_update = array(
				'servicio' => $this->input->post("servicio"),
			);

			if(is_numeric($this->input->post("estado"))){
				$data_update['estado'] =  1;
			}else{
				$data_update['estado'] = NULL;
			}

			$resp = $this->Servicios->update( $this->uri->segment(3) , $data_update);
			if($resp === TRUE){
				$this->session->set_flashdata("message",'<div class="alert alert-success">Registro actualizado con exito</div>');
			}else{
				$this->session->set_flashdata("message",'<div class="alert alert-warning">' . $resp . '</div>');
			}
			redirect(site_url(uri_string()));
		}

		$where = array(
			'id_servicio' => $this->uri->segment(3)
		);
		$data['servicio'] = $this->Servicios->select( $where , TRUE );
		$this->load->view('servicios/editar',$data);
	}

	public function agregar(){
		
		$this->output->unset_template();
		if(!in_array($this->session->userdata("id_rol"),array(1,3,4))){
			show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
		}		

		if(!$this->input->is_ajax_request()){
			show_error('Metodo de acceso invalido.', 401 , $heading = '401 No autorizado');
		}

		$this->form_validation->set_rules('servicio','servicio','trim|strip_tags|required');
		$this->form_validation->set_rules('estado','estado','trim|numeric');

		if($this->form_validation->run()){

			$data_insert = array(
				'servicio' => $this->input->post("servicio"),
				'estado' => $this->input->post("estado")
			);			

			$resp = $this->Servicios->insert( $data_insert );
			if($resp === TRUE){
				$this->session->set_flashdata("message",'<div class="alert alert-success">Registro agregado con exito</div>');
			}else{
				$this->session->set_flashdata("message",'<div class="alert alert-warning">' . $resp . '</div>');
			}
			redirect(site_url(uri_string()));
		}
		
		$this->load->view('servicios/agregar');
	}

}
