<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rates extends Logged{

	public function __construct(){

		parent::__construct();
		$this->load->library('form_validation');	
		$this->load->model( array('Tarifas','Detalles') );

	}

	public function index(){

		if(!in_array($this->session->userdata("id_rol"),array(1,3,4))){
			show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
		}

		if(!is_numeric($this->uri->segment(3))){
			show_error('Los parametros seleccionados no son validos', 500 , $heading = 'Error 500');
		}		

		if(is_array($this->input->post("eliminar"))){
			
			foreach ($this->input->post("eliminar") as $value) {
				$this->Tarifas->delete($value);
			}

			$where = array(
				'id_usuario' => $this->uri->segment(3) ,
				'en_oferta' => 1
			);

			$en_oferta = $this->Tarifas->select( $where , TRUE );
			$where = array("id_usuario" => $this->uri->segment(3) );
			$data_usuario = $this->Detalles->select($where);

			if(is_numeric($data_usuario['id_usuario'])){

				$where = array(
					'en_oferta' => $en_oferta ,
				);

				$resp = $this->Detalles->update( $data_usuario['id_usuario'] , $where );

			}else{
			
				$where = array(
					'id_usuario' => $this->uri->segment(3) ,
					'en_oferta' => $en_oferta
				);

				$resp = $this->Detalles->insert( $where );
			}

		}

		$where = array(
			'id_usuario' => $this->uri->segment(3)
		);

		$data['tarifas'] = $this->Tarifas->select($where);
		$this->load->view("rates/index",$data);
	}

	public function agregar(){

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

		$this->form_validation->set_rules('antes','antes','trim|numeric');
		$this->form_validation->set_rules('ahora','ahora','trim|numeric|required');
		$this->form_validation->set_rules('duracion','servicio','trim|strip_tags|required');

		if($this->form_validation->run()){

			$data_insert = array(
				'antes' => ( $this->input->post("antes") > 0 ) ? $this->input->post("antes") : NULL ,
				'ahora' => $this->input->post("ahora"),
				'condiciones' => $this->input->post("duracion"),
				'id_usuario' => $this->uri->segment(3) ,
				'en_oferta' => ($this->input->post("antes") > $this->input->post("ahora")) ? 1 : NULL 
			);

			$resp = $this->Tarifas->insert($data_insert);
			if($resp === TRUE){
				
				if($this->input->post("antes") > $this->input->post("ahora")){

					$where = array("id_usuario" => $this->uri->segment(3) );
					$data_usuario = $this->Detalles->select($where);
					if(is_numeric($data_usuario['id_usuario'])){

						$where = array(
							'en_oferta' => 1 ,
						);

						$resp = $this->Detalles->update( $data_usuario['id_usuario'] , $where );

					}else{
					
						$where = array(
							'id_usuario' => $this->uri->segment(3) ,
							'en_oferta' => 1
						);

						$resp = $this->Detalles->insert( $where );
					}

				}

				$this->session->set_flashdata("message",'<div class="alert alert-success">Registro creado con exito</div>');
			}else{
				$this->session->set_flashdata("message",'<div class="alert alert-warning">' . $resp . '</div>');
			}
			redirect(site_url(uri_string()));
		}

		$this->load->view("rates/agregar");
	}

}