<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activate extends MY_Controller {

	public function __construct(){

		parent::__construct();			
		$this->load->library('form_validation');
		$this->load->model(array('Usuarios'));

	}

	public function account(){

		$key = $this->uri->segment(3);
		if( !$key ){
			redirect(site_url());
		}

		$where = array(
			'usuarios.activar' => $key
		);

		$data = $this->Usuarios->select( $where , TRUE );
		
		if( is_numeric($data['id_usuario']) ){

			$where = array(
				'usuarios.activar' => NULL ,
				'usuarios.estado' => 1
			);

			$this->Usuarios->update( $data['id_usuario'] , $where );

			$this->session->set_flashdata("message",'<div class="alert alert-success text-center">Felicitaciones tu cuenta ya fue activada. Ahora puedes ingresar a tu cuenta haciendo click en este boton <br><br><a href="' . site_url('login') . '" class="btn btn-success"> INGRESAR </a></div>');
			redirect(site_url('activate/success'));

		}else{
			$this->session->set_flashdata("message",'<div class="alert alert-danger text-center">Lo sentimos la cuenta no existe, o ya fue activada.</div>');
			redirect(site_url('activate/error'));
		}

		$this->load->view( 'activate/account' , $data );
	}

	public function error(){

		$this->load->view( 'activate/account' );
	}

	public function success(){

		$this->load->view( 'activate/account' );
	}

}