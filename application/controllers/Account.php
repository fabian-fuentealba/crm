<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends Logged {

	var $id_usuario ;
	var $segment3 ;

	public function __construct(){

		parent::__construct();			
		$this->load->library('form_validation');
		$this->load->model(array('Usuarios','Parametros','Detalles','Tarifas','Fotos','Planes','Sitios','Contratos','Rel_usuarios_servicio','Rel_usuarios_lugares','Rel_usuarios_sitios','Contexturas','Cabellos','Horarios'));

		$this->id_usuario = $this->session->userdata('id_usuario');
		$this->segment3 = $this->uri->segment(3);

	}

	public function index(){	
	
		if(!in_array($this->session->userdata("id_rol"),array( 2 ))){
			show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
		}		

		$where = array(
			'contratos.id_usuario' => $this->id_usuario
		);
		
		$data['listado'] = $this->Contratos->select($where);
		$this->load->view('account/contracts',$data);
	
	}

	public function detalle(){

		if(!in_array( $this->session->userdata("id_rol") , array( 2 ))){
			show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
		}		

		$where = array( "id_usuario" => $this->id_usuario );
		$data_usuario = $this->Detalles->select($where);
	
		$this->form_validation->set_rules('pais','pais','trim|numeric|required');
		$this->form_validation->set_rules('alias','alias','trim|strip_tags|required');
		$this->form_validation->set_rules('fijo','teléfono fijo','trim|strip_tags');
		$this->form_validation->set_rules('celular','teléfono celular','trim|strip_tags');
		$this->form_validation->set_rules('altura','altura','trim|numeric|required');
		$this->form_validation->set_rules('peso','peso','trim|integer|greater_than[0]');
		$this->form_validation->set_rules('busto','busto','trim|integer|greater_than[0]');
		$this->form_validation->set_rules('cintura','cintura','trim|integer|greater_than[0]');
		$this->form_validation->set_rules('cadera','cadera','trim|integer|greater_than[0]');
		$this->form_validation->set_rules('presentacion','presentacion','trim');
		$this->form_validation->set_rules('region','region','trim|numeric|required');
		$this->form_validation->set_rules('comuna','comuna','trim|numeric|required');
		$this->form_validation->set_rules('contextura','contextura','trim|numeric|required');
		$this->form_validation->set_rules('cabello','cabello','trim|numeric|required');

		if($this->form_validation->run()){

			$data_sql = array(				
				'id_pais' => $this->input->post("pais"),
				'alias' => $this->input->post("alias"),
				'fijo' => $this->input->post("fijo"),
				'celular' => $this->input->post("celular"),
				'altura' => $this->input->post("altura"),
				'peso' => $this->input->post("peso"),
				'busto' => $this->input->post("busto"),
				'cintura' => $this->input->post("cintura"),
				'cadera' => $this->input->post("cadera"),
				'presentacion' => $this->input->post("presentacion"),			
				'id_region' => $this->input->post("region"),
				'id_comuna' => $this->input->post("comuna"),
				'id_cabello' => $this->input->post("cabello"),
				'id_contextura' => $this->input->post("contextura")
			);

			if(is_numeric($data_usuario['id_usuario'])){
				$resp = $this->Detalles->update( $this->id_usuario , $data_sql );
			}else{
				$data_sql['id_usuario'] = $this->id_usuario;
				$resp = $this->Detalles->insert( $data_sql );
			}
			if($resp === TRUE){
				$this->session->set_flashdata("message",'<div class="alert alert-success">Registro actualizado con exito</div>');
			}else{
				$this->session->set_flashdata("message",'<div class="alert alert-warning">' . $resp . '</div>');
			}
			redirect(site_url(uri_string()));

		}

		$data['contexturas'] = $this->Contexturas->select();
		$data['cabellos'] = $this->Cabellos->select();
		$data['categorias'] = $this->Parametros->select_categorias();
		$data['usuario'] = $this->Detalles->select($where);
		$data['paises'] = $this->Parametros->select_paises();
		$this->load->view('account/detalle',$data);

	}	

	public function rates(){

		if(!in_array($this->session->userdata("id_rol"),array( 2 ))){
			show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
		}			

		if(is_array($this->input->post("eliminar"))){
			
			foreach ($this->input->post("eliminar") as $value) {
				$this->Tarifas->delete($value);
			}

			$where = array(
				'id_usuario' => $this->id_usuario ,
				'en_oferta' => 1
			);

			$en_oferta = $this->Tarifas->select( $where , TRUE );
			$where = array("id_usuario" => $this->id_usuario );
			$data_usuario = $this->Detalles->select( $where );

			if(is_numeric($data_usuario['id_usuario'])){

				$where = array(
					'en_oferta' => $en_oferta ,
				);

				$resp = $this->Detalles->update( $data_usuario['id_usuario'] , $where );

			}else{
			
				$where = array(
					'id_usuario' => $this->id_usuario ,
					'en_oferta' => $en_oferta
				);

				$resp = $this->Detalles->insert( $where );
			}

		}

		$where = array(
			'id_usuario' => $this->id_usuario
		);

		$data['tarifas'] = $this->Tarifas->select($where);
		$this->load->view("account/rates",$data);
	}

	public function ratesadd(){

		$this->output->unset_template();

		if(!in_array($this->session->userdata("id_rol"),array( 2 ))){
			show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
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
				'id_usuario' => $this->id_usuario ,
				'en_oferta' => ($this->input->post("antes") > $this->input->post("ahora")) ? 1 : NULL 
			);

			$resp = $this->Tarifas->insert($data_insert);
			if($resp === TRUE){
				
				if($this->input->post("antes") > $this->input->post("ahora")){

					$where = array("id_usuario" => $this->id_usuario );
					$data_usuario = $this->Detalles->select($where);
					if(is_numeric($data_usuario['id_usuario'])){

						$where = array(
							'en_oferta' => 1 ,
						);

						$resp = $this->Detalles->update( $data_usuario['id_usuario'] , $where );

					}else{
					
						$where = array(
							'id_usuario' => $this->id_usuario ,
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

		$this->load->view("account/ratesadd");
	}


	public function services(){

		if(!in_array($this->session->userdata("id_rol"),array( 2 ))){
			show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
		}		

		if($this->input->server("REQUEST_METHOD") == "POST"){

			$where = array(
				'id_usuario' => $this->id_usuario,
			);

			$this->Rel_usuarios_servicio->delete($where);

			foreach ($this->input->post("servicio") as $key => $value) {
				$data_insert = array(
					'id_creador' => $this->id_usuario ,
					'id_servicio' => $key ,
					'id_usuario' => $this->id_usuario ,
					$value => 1
				);
				$this->Rel_usuarios_servicio->insert($data_insert);
			}
			redirect(site_url(uri_string()));
		}
		
		$data['servicios'] = $this->Rel_usuarios_servicio->select( $this->id_usuario );
		$this->load->view( 'account/services' , $data );

	}


	public function places(){

		if(!in_array($this->session->userdata("id_rol"),array( 2 ))){
			show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
		}

		$id_usuario = $this->id_usuario;

		if($this->input->server("REQUEST_METHOD") == "POST"){
			
			$where = array(
				'id_usuario' => $id_usuario ,
			);

			$this->Rel_usuarios_lugares->delete($where);
			foreach ($this->input->post("lugar") as $key => $value) {

				$data_insert = array(
					'id_lugar' => $value ,
					'id_usuario' => $id_usuario
				);
				$this->Rel_usuarios_lugares->insert( $data_insert );

			}
			redirect(site_url(uri_string()));
		}
		
		$data['lugares'] = $this->Rel_usuarios_lugares->select( $id_usuario );
		$this->load->view('account/places',$data);

	}

	public function contractsshow(){

		$this->output->unset_template();

		if(!in_array($this->session->userdata("id_rol"),array( 2 ))){
			show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
		}

		if(!is_numeric( $this->segment3 )){
			show_error('Los parametros seleccionados no son validos', 500 , $heading = 'Error 500');
		}		

		if(!$this->input->is_ajax_request()){
			show_error('Metodo de acceso invalido.', 401 , $heading = '401 No autorizado');
		}
		
		$data['contrato'] = $this->Contratos->select( array('id_contrato' => $this->segment3 ) , TRUE);
	
		$this->load->view('account/contractsshow',$data);
		
	}

	public function schedule(){

		if(!in_array($this->session->userdata("id_rol"),array( 2 ))){
			show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
		}

		if($this->input->server('REQUEST_METHOD') == 'POST' ){
			$this->Horarios->delete($this->id_usuario);
			foreach($this->input->post("dia") as $key => $value){

				if($value['desde'] AND $value['hasta']){

					$where = array(
						'id_usuario' => $this->id_usuario ,
						'dia' => $key ,
						'desde' => $value['desde'] ,
						'hasta' => $value['hasta']
					);

					$this->Horarios->insert( $where );
				}

			}
			redirect(site_url(uri_string()));			
		}

		$where = array(
			'horarios.id_usuario' => $this->id_usuario
		);

		$data['listado'] = $this->Horarios->select( $where );
		$this->load->view('account/schedule' , $data );

	}

}