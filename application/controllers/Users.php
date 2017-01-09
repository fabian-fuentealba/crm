<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends Logged {

	public function __construct(){

		parent::__construct();
		$this->load->library('form_validation');	
		$this->load->model(array('Usuarios','Parametros','Detalles','Tarifas','Fotos','Planes','Sitios','Contactos','Rel_usuarios_servicio','Rel_usuarios_lugares','Rel_usuarios_sitios','Contexturas','Cabellos'));

	}

	public function index(){

		if(!in_array($this->session->userdata("id_rol"),array(1,3))){
			show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
		}

		$this->form_validation->set_rules('buscar','buscar','trim|strip_tags');
		$buscar = array();
		if($this->form_validation->run()){

			$buscar = array(
				'usuarios.nombre' => $this->input->post('buscar') ,
				'usuarios.apellido' => $this->input->post('buscar')
			);
		}

		$data['listado'] = $this->Usuarios->select( array() , FALSE , $buscar );
		$this->load->view('users/index',$data);
		
	}

	public function menu(){

		$this->output->unset_template();
		if(!is_numeric($this->uri->segment(3))){
				show_error('Los parametros seleccionados no son validos', 500 , $heading = 'Error 500');
		}

		$data['id'] = $this->uri->segment(3);
		$this->load->view("users/menu",$data);

	}

	public function analytics(){
		
		if(!is_numeric($this->uri->segment(3))){
				show_error('Los parametros seleccionados no son validos', 500 , $heading = 'Error 500');
		}

		$data['id'] = $this->uri->segment(3);
		$this->load->view("users/analytics",$data);

	}

	public function editar(){

		if(!in_array($this->session->userdata("id_rol"),array(1,3)) AND $this->session->userdata("id_usuario") != $this->uri->segment(3) ){
			show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
		}

		if(!is_numeric($this->uri->segment(3))){
			show_error('Los parametros seleccionados no son validos', 500 , $heading = 'Error 500');
		}

		$this->form_validation->set_rules('rol','rol','trim|numeric|required');
		$this->form_validation->set_rules('nombres','nombre','trim|strip_tags|strtoupper');
		$this->form_validation->set_rules('apellidos','apellidos','trim|strip_tags|strtoupper');
		$this->form_validation->set_rules('f_nacimiento','fecha nacimiento','trim|strip_tags|required');
		$this->form_validation->set_rules('correo','correo','trim|strtolower|valid_email');
		$this->form_validation->set_rules('telefono_fijo','telefono fijo','trim|strip_tags');
		$this->form_validation->set_rules('telefono_celular','telefono celular','trim|strip_tags');
		$this->form_validation->set_rules('sexo','sexo','trim|numeric|required');
		$this->form_validation->set_rules('usuario','usuario','trim|strip_tags|min_length[6]');
		$this->form_validation->set_rules('password','password','trim|strip_tags|min_length[6]');		
		$this->form_validation->set_rules('sitio[]','sitio','trim|numeric|required');		

		if($this->form_validation->run()){

			$data_update = array(

				'nombre' => $this->input->post("nombres"),
				'apellido' => $this->input->post("apellidos"),
				'fecha_nacimiento' => $this->input->post("f_nacimiento"),
				'email' => $this->input->post("correo"),
				'sexo' => $this->input->post("sexo"),
				'id_pais' => 1 , 				
				'fijo' => $this->input->post("telefono_fijo"),
				'celular' => $this->input->post("telefono_celular"),				

			);

			if(in_array($this->session->userdata("id_rol"),array(1))){
				$data_update['id_rol'] = $this->input->post("rol");
			}

			if($this->input->post("usuario") != '' AND $this->input->post("password") != ''){
				$data_update['usuario'] = $this->input->post("usuario");
				$data_update['password'] = sha1($this->input->post("password"));
			}		

			if(is_numeric($this->input->post("estado"))){
				$data_update['estado'] = 1;
			}else{
				$data_update['estado'] = NULL;
			}

			$resp = $this->Usuarios->update( $this->uri->segment(3) , $data_update );		
			$this->Rel_usuarios_sitios->delete($this->uri->segment(3));

			foreach ($this->input->post("sitio") as $value) {
				$data_insert = array(
					'id_usuario' => $this->uri->segment(3) ,
					'id_sitio' => $value
				);
				$this->Rel_usuarios_sitios->insert($data_insert);
			}

			if($resp === TRUE){
				$this->session->set_flashdata("message",'<div class="alert alert-success">Registro actualizado con exito</div>');
			}else{
				$this->session->set_flashdata("message",'<div class="alert alert-warning">' . $resp . '</div>');
			}
			redirect(site_url(uri_string()));
		}
		$data_select = array(
			'usuarios.id_usuario' => $this->uri->segment(3)
		);
		$data['usuario'] = $this->Usuarios->select( $data_select , TRUE );
		$where = array(
			'estado' => 1
		);
	
		foreach($this->Rel_usuarios_sitios->select( array('id_usuario' => $this->uri->segment(3))) as $value){
			$data['rel_sitios'][] = $value['id_sitio'];
		}
		
		$data['roles'] = $this->Parametros->select_roles( $where );
		$data['sitios'] = $this->Parametros->select_sitios();
		$data['paises'] = $this->Parametros->select_paises();
		$this->load->view('users/editar',$data);
	}

	public function agregar(){

		if(!in_array($this->session->userdata("id_rol"),array(1,3))){
			show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
		}

		$this->form_validation->set_rules('sitio[]','sitio','trim|numeric|required');
		$this->form_validation->set_rules('rol','rol','trim|numeric|required');
		$this->form_validation->set_rules('nombres','nombre','trim|strip_tags|strtolower|ucwords');
		$this->form_validation->set_rules('apellidos','apellido','trim|strip_tags|strtolower|ucwords');
		$this->form_validation->set_rules('f_nacimiento','fecha nacimiento','trim|strip_tags|required');
		$this->form_validation->set_rules('correo','correo','trim|strtolower|valid_email');
		$this->form_validation->set_rules('telefono_fijo','telefono fijo','trim|strip_tags');
		$this->form_validation->set_rules('telefono_celular','telefono celular','trim|strip_tags|required');
		$this->form_validation->set_rules('sexo','sexo','trim|numeric|required');
		$this->form_validation->set_rules('usuario','usuario','trim|strip_tags|min_length[6]');				
		$this->form_validation->set_rules('password','password','trim|strip_tags|min_length[6]');
		
		if($this->form_validation->run()){

			$data_insert = array(

					'id_rol' => $this->input->post("rol"),
					'nombre' => $this->input->post("nombres"),
					'apellido' => $this->input->post("apellidos"),
					'fecha_nacimiento' => $this->input->post("f_nacimiento"),
					'email' => $this->input->post("correo"),						
					'sexo' => $this->input->post("sexo"),
					'id_pais' => 1 ,
					'id_region' => $this->input->post("region"),
					'id_comuna' => $this->input->post("comuna"),
					'fijo' => $this->input->post("telefono_fijo"),
					'celular' => $this->input->post("telefono_celular"),

			);

			if($this->input->post("usuario") != '' AND $this->input->post("password") != ''){
				$data_insert['usuario'] = $this->input->post("usuario");
				$data_insert['password'] = sha1($this->input->post("password"));
			}			

			$id = $this->Usuarios->insert($data_insert);
			if(is_numeric($id)){
				$this->load->model('Rel_usuarios_sitios');
				foreach ($this->input->post("sitio") as $key => $value) {
					$data_insert = array(
						'id_usuario' => $id ,
						'id_sitio' => $value
					);
					$this->Rel_usuarios_sitios->insert($data_insert);
				}
				$this->session->set_flashdata("message",'<div class="alert alert-success">Registro creado con exito</div>');
				redirect(site_url(uri_string()));
			}else{
				$this->session->set_flashdata("message",'<div class="alert alert-warning">' . $id . '</div>');
			}
			
		}
		

		$data['sitios'] = $this->Parametros->select_sitios();
		$where = array(
				'estado' => 1
		);

		if($this->session->userdata("id_rol") == 4){
				$where['id_rol'] = 2;
		}
		$data['roles'] = $this->Parametros->select_roles( $where );
		$data['paises'] = $this->Parametros->select_paises();
		$this->load->view('users/agregar',$data);
	}		

	public function detalle(){

		if(!in_array($this->session->userdata("id_rol"),array(1,3))){
			show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
		}

		if(!is_numeric($this->uri->segment(3))){
			show_error('Los parametros seleccionados no son validos', 500 , $heading = 'Error 500');
		}

		$where = array("id_usuario" => $this->uri->segment(3) );
		$data_usuario = $this->Detalles->select($where);

		$this->form_validation->set_rules('posicion','posición','trim|integer|is_natural_no_zero');
		$this->form_validation->set_rules('categoria','categoria','trim|numeric|required');
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
				'id_categoria' => $this->input->post("categoria"),
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
				'posicion' => $this->input->post("posicion"),
				'id_region' => $this->input->post("region"),
				'id_comuna' => $this->input->post("comuna"),
				'id_cabello' => $this->input->post("cabello"),
				'id_contextura' => $this->input->post("contextura")
			);

			if(is_numeric($data_usuario['id_usuario'])){
				$resp = $this->Detalles->update( $this->uri->segment(3) , $data_sql);
			}else{
				$data_sql['id_usuario'] = $this->uri->segment(3);
				$resp = $this->Detalles->insert($data_sql);
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
		$this->load->view('users/detalle',$data);

	}

	
}