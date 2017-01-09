<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contracts extends Logged{

	public function __construct(){

		parent::__construct();			
		$this->load->library('form_validation');
		$this->load->model( array('Parametros','Tarifas','Planes','Sitios','Contactos','Rel_formas_pago') );

	}

	public function index(){

		$this->load->model('Contratos');
		if(!in_array($this->session->userdata("id_rol"),array(1,3,4))){
			show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
		}

		if(!is_numeric($this->uri->segment(3))){
			show_error('Los parametros seleccionados no son validos', 500 , $heading = 'Error 500');
		}

		$where = array(
			'contratos.id_usuario' => $this->uri->segment(3)
		);

		$data['listado'] = $this->Contratos->select($where);
		$this->load->view('contracts/index',$data);
	}

	public function ver(){

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

		$this->load->model(array('Contratos','Rel_formas_pago'));
		$data['contrato'] = $this->Contratos->select( array('id_contrato' => $this->uri->segment(3)) , TRUE);
		$data['formas_pago'] = $this->Rel_formas_pago->select( array('id_contrato' => $this->uri->segment(3)) );
		$this->load->view('contracts/ver',$data);
		
	}

	public function agregar(){

		if(!in_array($this->session->userdata("id_rol"),array(1,3,4))){
			show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
		}

		if(!is_numeric($this->uri->segment(3))){
			show_error('Los parametros seleccionados no son validos', 500 , $heading = 'Error 500');
		}

		$this->load->model(array('Contratos','Rel_formas_pago'));
		$this->form_validation->set_rules('plan','plan','trim|numeric|required');
		$this->form_validation->set_rules('desde','desde','trim|strip_tags|required');
		$this->form_validation->set_rules('hasta','hasta','trim|strip_tags|required');
		$this->form_validation->set_rules('a_pagar','a pagar','trim|numeric|required');
		$this->form_validation->set_rules('abonado','abonado','trim|numeric|required|matches[a_pagar]');

		$this->form_validation->set_rules('detalle_pago[]','detalles','trim|strip_tags|required');
		$this->form_validation->set_rules('monto_pago[]','valor','trim|numeric|required|greater_than[0]');

		if($this->form_validation->run()){

			$data_insert = array(
				'id_usuario' => $this->uri->segment(3),
				'id_plan' => $this->input->post("plan"),
				'valor' => $this->input->post("a_pagar"),
				'desde' => $this->input->post("desde"),
				'hasta' => $this->input->post("hasta"),
			);

			$resp = $this->Contratos->insert( $data_insert );
			if(is_numeric($resp) AND $resp > 0 ){

				foreach ($this->input->post("id_pago") as $key => $value) {

					$detalle_pago = $this->input->post("detalle_pago");
					$monto_pago = $this->input->post("monto_pago");

					$data_insert = array(
						'id_contrato' => $resp ,
						'id_forma_pago' => $value ,
						'detalle' => $detalle_pago[$key] ,
						'monto' => $monto_pago[$key]
					);

					$this->Rel_formas_pago->insert($data_insert);
				}

				$this->session->set_flashdata("message",'<div class="alert alert-success">Registro creado con exito</div>');
			}else{
				$this->session->set_flashdata("message",'<div class="alert alert-warning">' . $resp . '</div>');
			}
			redirect(site_url(uri_string()));

		}

		$data['pagos'] = $this->input->post("id_pago");
		$data['detalles'] = $this->input->post("detalle_pago");
		$data['monto_pago'] = $this->input->post("monto_pago");

		$data['formas_pago'] = $this->Parametros->select_formas_pago();
		$data['planes'] = $this->Planes->select(array('estado' => 1 ));
		$this->load->view('contracts/agregar',$data);
	}		


}