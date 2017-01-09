<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends Logged {

	public function __construct(){

		parent::__construct();

		if(!in_array($this->session->userdata("id_rol"),array(1))){
			show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
		}		
		
		$this->load->library('form_validation');
		$this->load->model(array('Usuarios','Categorias'));

	}

	public function index(){

		$data['categorias'] = $this->Categorias->select();
		$this->load->view( "categorias/index" , $data );

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

		$this->form_validation->set_rules('categoria','categoria','trim|strip_tags|strtoupper|required');
		$this->form_validation->set_rules('controlador','controlador','trim|strip_tags|strtolower|required');
		$this->form_validation->set_rules('estado','estado','trim|numeric');

		if($this->form_validation->run()){

			$data_update = array(
				'categoria' => $this->input->post("categoria"),
				'controlador' => $this->input->post("controlador"),
			);

			if(is_numeric($this->input->post("estado"))){
				$data_update['estado'] =  1;
			}else{
				$data_update['estado'] = NULL;
			}

			$resp = $this->Categorias->update( $this->uri->segment(3) , $data_update);
			if($resp === TRUE){
				$this->session->set_flashdata("message",'<div class="alert alert-success">Registro actualizado con exito</div>');
			}else{
				$this->session->set_flashdata("message",'<div class="alert alert-warning">' . $resp . '</div>');
			}
			redirect(site_url(uri_string()));
		}

		$where = array(
			'id_categoria' => $this->uri->segment(3)
		);

		$data['categoria'] = $this->Categorias->select( $where , FALSE );
		$this->load->view('categorias/editar',$data);
	}

	public function agregar(){
		
		$this->output->unset_template();
		if(!in_array($this->session->userdata("id_rol"),array(1,3,4))){
			show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
		}		

		if(!$this->input->is_ajax_request()){
			show_error('Metodo de acceso invalido.', 401 , $heading = '401 No autorizado');
		}

		$this->form_validation->set_rules('categoria','categoria','trim|strip_tags|strtoupper|required');
		$this->form_validation->set_rules('controlador','controlador','trim|strip_tags|strtolower|required');
		$this->form_validation->set_rules('estado','estado','trim|numeric');

		if($this->form_validation->run()){

			$data_insert = array(
				'categoria' => $this->input->post("categoria"),
				'controlador' => $this->input->post("controlador"),
				'estado' => $this->input->post("estado")
			);			

			$resp = $this->Categorias->insert( $data_insert );
			if($resp === TRUE){
				$this->session->set_flashdata("message",'<div class="alert alert-success">Registro agregado con exito</div>');
			}else{
				$this->session->set_flashdata("message",'<div class="alert alert-warning">' . $resp . '</div>');
			}
			redirect(site_url(uri_string()));
		}
		
		$this->load->view('categorias/agregar');
	}
}