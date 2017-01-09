<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profiles extends Logged {

	public function __construct(){

		parent::__construct();
		$this->load->library('form_validation');	
		$this->load->model(array('Usuarios','Parametros','Detalles','Tarifas','Fotos','Planes','Sitios','Contactos','Rel_usuarios_servicio','Rel_usuarios_lugares','Rel_usuarios_sitios'));

	}

	public function editar(){		

		$this->output->unset_template();	
		$this->form_validation->set_rules('nombres','nombre','trim|strip_tags|strtoupper');
		$this->form_validation->set_rules('apellidos','apellidos','trim|strip_tags|strtoupper');
		$this->form_validation->set_rules('f_nacimiento','fecha nacimiento','trim|strip_tags|required');
		$this->form_validation->set_rules('correo','correo','trim|strtolower|valid_email');
		$this->form_validation->set_rules('telefono_fijo','telefono fijo','trim|strip_tags');
		$this->form_validation->set_rules('telefono_celular','telefono celular','trim|strip_tags|required');
		$this->form_validation->set_rules('sexo','sexo','trim|numeric|required');
		$this->form_validation->set_rules('usuario','usuario','trim|strip_tags|min_length[4]');
		$this->form_validation->set_rules('password','password','trim|strip_tags|min_length[4]');				

		if($this->form_validation->run()){

			$data_update = array(

				'nombre' => $this->input->post("nombres"),
				'apellido' => $this->input->post("apellidos"),
				'fecha_nacimiento' => $this->input->post("f_nacimiento"),
				'email' => $this->input->post("correo"),
				'sexo' => $this->input->post("sexo"),								
				'fijo' => $this->input->post("telefono_fijo"),
				'celular' => $this->input->post("telefono_celular"),				

			);

			if( $this->input->post("usuario") != NULL ){
				
				$data_update['usuario'] = $this->input->post("usuario");
				
			}

			if( $this->input->post("password") != NULL ){				
				
				$data_update['password'] = sha1($this->input->post("password"));
			}

			$resp = $this->Usuarios->update( $this->session->userdata("id_usuario") , $data_update );				

			if($resp === TRUE){
				$this->session->set_flashdata("message",'<div class="alert alert-success">Registro actualizado con exito</div>');
			}else{
				$this->session->set_flashdata("message",'<div class="alert alert-warning">' . $resp . '</div>');
			}
			redirect(site_url(uri_string()));
		}
		
		$data_select = array(
			'usuarios.id_usuario' =>  $this->session->userdata("id_usuario")
		);

		$data['usuario'] = $this->Usuarios->select( $data_select , TRUE );
		
		$where = array(
			'estado' => 1
		);
	
		foreach($this->Rel_usuarios_sitios->select( array('id_usuario' =>  $this->session->userdata("id_usuario") )) as $value){
			$data['rel_sitios'][] = $value['id_sitio'];
		}		
	
		$data['sitios'] = $this->Parametros->select_sitios();		
		$this->load->view('profiles/editar', $data);
	}

}