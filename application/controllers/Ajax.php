<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends Logged {

	public function __construct(){

		parent::__construct();
		$this->output->unset_template();		
		$this->load->model(array('Usuarios','Parametros','Planes'));

	}

	public function regiones(){

		if($this->input->is_ajax_request()){
			if(is_numeric($this->uri->segment(3))){
				$where = array(
					'id_pais' => $this->uri->segment(3)
				);				
				$data['listado'] = $this->Parametros->select_regiones( NULL , $where );
				$data['selec'] = $this->input->post("s");
				$this->load->view('ajax/regiones',$data);
			}	
		}else{
			if(!is_numeric($this->uri->segment(3))){
				show_error('El modo de acceso no es valido', 401 , $heading = 'Error 401');
			}
		}

	}

	public function comunas(){

		if($this->input->is_ajax_request()){
			if(is_numeric($this->uri->segment(3))){
				$where = array(
					'id_region' => $this->uri->segment(3)
				);			
				$data['listado'] = $this->Parametros->select_comunas( NULL , $where );
				$data['selec'] = $this->input->post("s");
				$this->load->view('ajax/comunas',$data);
			}	
		}else{
			if(!is_numeric($this->uri->segment(3))){
				show_error('El modo de acceso no es valido', 401 , $heading = 'Error 401');
			}
		}

	}

	public function valor_plan(){

		if($this->input->is_ajax_request()){
			if(is_numeric($this->input->post("p"))){
				$where = array(
					'id_plan' => $this->input->post("p")
				);			
				$plan = $this->Planes->select( $where , TRUE );
				echo $plan['valor'];
			}	
		}else{
			if(!is_numeric($this->uri->segment(3))){
				show_error('El modo de acceso no es valido', 401 , $heading = 'Error 401');
			}
		}

	}
}