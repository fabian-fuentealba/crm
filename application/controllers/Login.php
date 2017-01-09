<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct(){

		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model(array('Usuarios'));

	}

	public function index(){

		$this->form_validation->set_rules('usuario','usuario','trim|strip_tags|required');
		$this->form_validation->set_rules('password','password','trim|strip_tags|required');

		if($this->input->is_ajax_request()){
			$this->output->unset_template();
		}

		if($this->form_validation->run()){

			$data_select = array(
				'usuario' => $this->input->post("usuario"),
				'password' => sha1($this->input->post("password")),
				'usuarios.estado' => 1
			);

			$data = $this->Usuarios->select($data_select , TRUE , array() , TRUE );
			if(is_numeric($data['id_usuario'])){
				$data['logged_in'] = TRUE ;
				$this->session->set_userdata($data);
				redirect(site_url('admin'));
			}else{
				$this->session->set_flashdata("message",'<div class="alert alert-warning">Los datos ingresados no son validos</div>');
				redirect(site_url(uri_string()));
			}

		}

		$this->load->view('login');

	}

}