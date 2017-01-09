<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Logged {

	public function __construct(){

		parent::__construct();			
		$this->load->library('form_validation');
		$this->load->model(array('Usuarios','Parametros','Detalles','Tarifas','Fotos','Planes','Sitios','Contactos','Rel_usuarios_servicio','Rel_usuarios_lugares','Rel_usuarios_sitios'));

	}

	public function index(){

		if(!in_array($this->session->userdata("id_rol"),array(1,3,4))){
			redirect(site_url('account'));
			exit();
		}

		$this->load->js('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js');
		$this->load->js('assets/js/charts.js');
		$this->load->model(array('Categorias','Visitas'));
		$data['categorias'] = $this->Categorias->count();
		$data['visitas'] = $this->Visitas->select();
		$this->load->view('admin/index',$data);
	}

	public function lugares_usuario(){

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
			$this->Rel_usuarios_lugares->delete($where);
			foreach ($this->input->post("lugar") as $key => $value) {
				$data_insert = array(
					'id_lugar' => $value ,
					'id_usuario' => $this->uri->segment(3)
				);
				$this->Rel_usuarios_lugares->insert($data_insert);
			}
			redirect(site_url(uri_string()));
		}
		
		$data['lugares'] = $this->Rel_usuarios_lugares->select( $this->uri->segment(3) );
		$this->load->view('admin/lugares_usuario',$data);

	}	

	public function paises(){

		if(!in_array($this->session->userdata("id_rol"),array(1,3,4))){
			show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
		}

		$data['paises'] = $this->Parametros->select_paises();
		$this->load->view("admin/paises",$data);
	}

	public function regiones(){

		if(!in_array($this->session->userdata("id_rol"),array(1,3,4))){
			show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
		}

		if(!is_numeric($this->uri->segment(3))){
			show_error('Los parametros seleccionados no son validos', 500 , $heading = 'Error 500');
		}

		$where = array(
			'id_pais' => $this->uri->segment(3)
		);

		$data['pais'] = $this->Parametros->select_paises($this->uri->segment(3));
		$data['regiones'] = $this->Parametros->select_regiones( NULL , $where );
		$this->load->view("admin/regiones",$data);
	}

	public function agregar_region(){

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

		$this->form_validation->set_rules('region','region','trim|strip_tags|strtoupper|required');
		$this->form_validation->set_rules('estado','estado','trim|numeric');

		if($this->form_validation->run()){

			$data_insert = array(

				'region' => $this->input->post("region"),
				'id_pais' => $this->uri->segment(3),
				'estado' => $this->input->post("estado")
			);

			$resp = $this->Parametros->insert_region($data_insert);
			if($resp === TRUE){
				$this->session->set_flashdata("message",'<div class="alert alert-success">Registro creado con exito</div>');
			}else{
				$this->session->set_flashdata("message",'<div class="alert alert-warning">' . $resp . '</div>');
			}
			redirect(site_url(uri_string()));
		}

		$this->load->view("admin/agregar_region");
	}

	public function comunas(){

		if(!in_array($this->session->userdata("id_rol"),array(1,3,4))){
			show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
		}

		if(!is_numeric($this->uri->segment(3))){
			show_error('Los parametros seleccionados no son validos', 500 , $heading = 'Error 500');
		}

		$where = array( 'id_region' => $this->uri->segment(3) );

		$data['region'] = $this->Parametros->select_regiones( $this->uri->segment(3) );
		$data['comunas'] = $this->Parametros->select_comunas( NULL , $where);
		$this->load->view("admin/comunas",$data);
	}

	public function agregar_comuna(){

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

		$this->form_validation->set_rules('comuna','comuna','trim|strip_tags|strtoupper|required');
		$this->form_validation->set_rules('estado','estado','trim|numeric');

		if($this->form_validation->run()){

			$data_insert = array(

				'comuna' => $this->input->post("comuna"),
				'id_region' => $this->uri->segment(3),
				'estado' => $this->input->post("estado")
			);

			$resp = $this->Parametros->insert_comuna($data_insert);
			if($resp === TRUE){
				$this->session->set_flashdata("message",'<div class="alert alert-success">Registro creado con exito</div>');
			}else{
				$this->session->set_flashdata("message",'<div class="alert alert-warning">' . $resp . '</div>');
			}
			redirect(site_url(uri_string()));
		}

		$this->load->view("admin/agregar_comuna");
	}

	public function editar_comuna(){

		$this->output->unset_template();
		if(!in_array($this->session->userdata("id_rol"),array(1,3,4))){
			show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
		}

		if(!is_numeric($this->uri->segment(3))){
			show_error('Los parametros seleccionados no son validos', 500 , $heading = 'Error 500');
		}

		
		$this->form_validation->set_rules('comuna','comuna','trim|strip_tags|strtoupper|required');
		$this->form_validation->set_rules('estado','estado','trim|numeric');

		if($this->form_validation->run()){

			$data_update = array(
				'comuna' => $this->input->post("comuna"),
			);

			if(is_numeric($this->input->post("estado"))){
				$data_update['estado'] =  1;
			}else{
				$data_update['estado'] = NULL;
			}

			$resp = $this->Parametros->update_comuna( $this->uri->segment(3) , $data_update);
			if($resp === TRUE){
				$this->session->set_flashdata("message",'<div class="alert alert-success">Registro actualizado con exito</div>');
			}else{
				$this->session->set_flashdata("message",'<div class="alert alert-warning">' . $resp . '</div>');
			}
			redirect(site_url(uri_string()));
		}

		$data['comuna'] = $this->Parametros->select_comunas( $this->uri->segment(3) );
		$this->load->view("admin/editar_comuna",$data);
	}

	public function editar_region(){

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

		$this->form_validation->set_rules('region','region','trim|strip_tags|strtoupper|required');
		$this->form_validation->set_rules('estado','estado','trim|numeric');

		if($this->form_validation->run()){

			$data_update = array(
				'region' => $this->input->post("region"),
			);

			if(is_numeric($this->input->post("estado"))){
				$data_update['estado'] =  1;
			}else{
				$data_update['estado'] = NULL;
			}

			$resp = $this->Parametros->update_region( $this->uri->segment(3) , $data_update);
			if($resp === TRUE){
				$this->session->set_flashdata("message",'<div class="alert alert-success">Registro actualizado con exito</div>');
			}else{
				$this->session->set_flashdata("message",'<div class="alert alert-warning">' . $resp . '</div>');
			}
			redirect(site_url(uri_string()));
		}

		$data['region'] = $this->Parametros->select_regiones( $this->uri->segment(3) );
		$this->load->view("admin/editar_region",$data);
	}

	public function agregar_pais(){

		$this->output->unset_template();

		if(!in_array($this->session->userdata("id_rol"),array(1,3,4))){
			show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
		}

		if(!$this->input->is_ajax_request()){
			show_error('Metodo de acceso invalido.', 401 , $heading = '401 No autorizado');
		}

		$this->form_validation->set_rules('pais','pais','trim|strip_tags|strtoupper|required');
		$this->form_validation->set_rules('nic','nic','trim|strip_tags|strtolower|required');
		$this->form_validation->set_rules('estado','estado','trim|numeric');

		if($this->form_validation->run()){

			$data_insert = array(

				'pais' => $this->input->post("pais"),
				'nic' => $this->input->post("nic"),
				'estado' => $this->input->post("estado")
			);

			$resp = $this->Parametros->insert_pais($data_insert);
			if($resp === TRUE){
				$this->session->set_flashdata("message",'<div class="alert alert-success">Registro creado con exito</div>');
			}else{
				$this->session->set_flashdata("message",'<div class="alert alert-warning">' . $resp . '</div>');
			}
			redirect(site_url(uri_string()));
		}

		$data['paises'] = $this->Parametros->select_paises();
		$this->load->view("admin/agregar_pais",$data);
	}

	public function editar_pais(){

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

		$this->form_validation->set_rules('pais','pais','trim|strip_tags|strtoupper|required');
		$this->form_validation->set_rules('nic','nic','trim|strip_tags|strtolower|required');
		$this->form_validation->set_rules('estado','estado','trim|numeric');

		if($this->form_validation->run()){

			$data_update = array(
				'pais' => $this->input->post("pais"),
				'nic' => $this->input->post("nic"),
			);

			if(is_numeric($this->input->post("estado"))){
				$data_update['estado'] =  1;
			}else{
				$data_update['estado'] = NULL;
			}

			$resp = $this->Parametros->update_pais( $this->uri->segment(3) , $data_update);
			if($resp === TRUE){
				$this->session->set_flashdata("message",'<div class="alert alert-success">Registro actualizado con exito</div>');
			}else{
				$this->session->set_flashdata("message",'<div class="alert alert-warning">' . $resp . '</div>');
			}
			redirect(site_url(uri_string()));
		}

		$data['pais'] = $this->Parametros->select_paises( $this->uri->segment(3) );
		$this->load->view("admin/editar_pais",$data);
	}	

}