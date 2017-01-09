<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plans extends Logged {

	public function __construct(){

		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model(array('Usuarios','Planes'));

	}

	public function index(){

		if(!in_array($this->session->userdata("id_rol"),array(1,3))){
			show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
		}

		$data['planes'] = $this->Planes->select();
		$this->load->view('planes/index',$data);
	}

	public function agregar(){

		$this->output->unset_template();

		if(!in_array($this->session->userdata("id_rol"),array(1,3))){
			show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
		}

		if(!$this->input->is_ajax_request()){
			show_error('Metodo de acceso invalido.', 401 , $heading = '401 No autorizado');
		}

		$this->form_validation->set_rules('plan','plan','trim|strip_tags|strtoupper|required');
		$this->form_validation->set_rules('lugar','lugar','trim|numeric|required|greater_than[0]');
		$this->form_validation->set_rules('valor','valor','trim|numeric|required|greater_than[0]');
		$this->form_validation->set_rules('duracion','duracion','trim|numeric|required|greater_than[0]');
		$this->form_validation->set_rules('estado','estado','trim|numeric');

		if($this->form_validation->run()){

			$data_insert = array(
				'plan' => $this->input->post("plan"),
				'lugar' => $this->input->post("lugar"),
				'valor' => $this->input->post("valor"),
				'duracion' => $this->input->post("duracion"),
				'estado' => $this->input->post("estado")
			);

			$resp = $this->Planes->insert($data_insert);
			if($resp === TRUE){
				$this->session->set_flashdata("message",'<div class="alert alert-success">Registro creado con exito</div>');
			}else{
				$this->session->set_flashdata("message",'<div class="alert alert-warning">' . $resp . '</div>');
			}
			redirect(site_url(uri_string()));

		}

		$this->load->view('planes/agregar');
	}

	public function editar(){

		$this->output->unset_template();

		if(!in_array($this->session->userdata("id_rol"),array(1,3))){
			show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
		}

		if(!$this->input->is_ajax_request()){
			show_error('Metodo de acceso invalido.', 401 , $heading = '401 No autorizado');
		}

		$this->form_validation->set_rules('plan','plan','trim|strip_tags|strtoupper|required');
		$this->form_validation->set_rules('lugar','lugar','trim|numeric|required|greater_than[0]');
		$this->form_validation->set_rules('valor','valor','trim|numeric|required|greater_than[0]');
		$this->form_validation->set_rules('duracion','duracion','trim|numeric|required|greater_than[0]');
		$this->form_validation->set_rules('estado','estado','trim|numeric');

		if($this->form_validation->run()){

			$data_update = array(
				'plan' => $this->input->post("plan"),
				'lugar' => $this->input->post("lugar"),
				'valor' => $this->input->post("valor"),
				'duracion' => $this->input->post("duracion")
			);

			if(is_numeric($this->input->post("estado"))){
				$data_update['estado'] = 1;
			}else{
				$data_update['estado'] = NULL;
			}

			$resp = $this->Planes->update( $this->uri->segment(3) , $data_update );
			if($resp === TRUE){
				$this->session->set_flashdata("message",'<div class="alert alert-success">Registro actualizado con exito</div>');
			}else{
				$this->session->set_flashdata("message",'<div class="alert alert-warning">' . $resp . '</div>');
			}
			redirect(site_url(uri_string()));

		}

		$data['plan'] = $this->Planes->select(array('id_plan' => $this->uri->segment(3)) , TRUE );
		$this->load->view('planes/editar',$data);
	}


}
