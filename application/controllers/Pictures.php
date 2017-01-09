<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pictures extends Logged {	

	public function __construct(){

		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model(array('Usuarios','Parametros','Detalles','Tarifas','Fotos','Planes','Sitios','Contactos','Rel_usuarios_servicio','Rel_usuarios_lugares','Rel_usuarios_sitios'));

	}

	public function index(){

		if(!in_array($this->session->userdata("id_rol"),array(1,3,4))){
			show_error('Ud no tiene privilegios para ingresar a este modulo.', 401 , $heading = '401 No autorizado');
		}

		if(!is_numeric($this->uri->segment(3))){
			show_error('Los parametros seleccionados no son validos', 500 , $heading = 'Error 500');
		}

		if(count($this->input->post("eliminar")) > 0){
			foreach ($this->input->post("eliminar") as $key => $value) {
				$foto = $this->Fotos->select( array('id_foto' => $value) , TRUE );
				if(unlink('./assets/uploads/' . $foto['id_sitio'] . '/' . $foto['id_usuario'].'/'.$foto['imagen']) AND unlink('./assets/uploads/' . $foto['id_sitio'] . '/' . $foto['id_usuario'].'/'.$foto['thumb'])){
					$data_delete = array(
						'id_foto' => $value 
					);
					$this->Fotos->delete($data_delete);
				}
			}
			redirect(site_url(uri_string()));
		}

		if($this->input->post("perfil") != ''){

			$part = explode('-', $this->input->post("perfil") );

			$data_update = array( 
				'es_perfil' => NULL ,				
			);

			$where = array( 
				"id_usuario" => $this->uri->segment(3),
				'id_sitio' => $part[1]
			);

			$this->Fotos->update( $where , $data_update );
			
			$data_update = array(
				'es_perfil' => 1 ,
				'id_sitio' => $part[1]
			);

			$where = array( 
				"id_foto" => $this->input->post("perfil")
			);

			$this->Fotos->update( $where , $data_update );

		}

		$where = array( 
			'id_usuario' => $this->uri->segment(3)
		);
		$data['fotos'] = $this->Fotos->select($where);
		$this->load->view("pictures/index",$data);

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

		$this->load->library('upload');
		$this->load->library('image_lib');

		$this->form_validation->set_rules('sitio','sitio','trim|numeric|required');

		if($this->form_validation->run()){

			$filename = './assets/uploads/' . $this->input->post("sitio");
			if(!is_dir($filename)){
				mkdir($filename,0777);
			}

			$filename = './assets/uploads/' . $this->input->post("sitio") . '/' . $this->uri->segment(3);
			if(!is_dir($filename)){
				mkdir($filename,0777);
			}

			$config['upload_path'] = $filename;
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['encrypt_name'] = TRUE;
			$config['overwrite'] = TRUE;
			$this->upload->initialize($config);

			if($this->upload->do_upload()){

				$imagen = $this->upload->data();

				$size['image_library'] = 'gd2';
				$size['source_image'] = $imagen['full_path'];
				$size['maintain_ratio'] = TRUE;
				$size['width'] = 570 ;
				$size['quality'] = '100%';
				$this->image_lib->initialize($size);
				$this->image_lib->resize();

				$water['source_image'] = $imagen['full_path'];
				$water['wm_text'] = $this->sites[$this->input->post("sitio")];
				$water['wm_type'] = 'text';
				$water['wm_font_path'] = './system/fonts/font.ttf';
				$water['wm_font_size'] = '22';
				$water['wm_font_color'] = '666666';
				$water['quality'] = $size['quality'];
				$water['wm_vrt_alignment'] = 'bottom';
				$water['wm_hor_alignment'] = 'center';
				$water['wm_padding'] = '-20';
				$this->image_lib->initialize($water);
				$this->image_lib->watermark();

				$thumb['image_library'] = 'gd2';
				$thumb['source_image'] = $imagen['full_path'];
				$thumb['maintain_ratio'] = TRUE;
				$thumb['quality'] = $size['quality'];
				$thumb['new_image'] = $filename.'/'.$imagen['raw_name']."_thumb".$imagen['file_ext'];
				$thumb['width'] = 353 ;
				$this->image_lib->initialize($thumb);
				$this->image_lib->resize();

				if($this->input->post("perfil")){
					$data_update = array(
						'es_perfil' => NULL
					);
					$where = array(
						"id_usuario" => $this->uri->segment(3),
						"id_sitio" => $this->input->post("sitio")
					);
					$this->Fotos->update( $where , $data_update );
				}

				$data_insert = array(
					'id_usuario' => $this->uri->segment(3),
					'imagen' => $imagen['file_name'],
					'es_perfil' => $this->input->post("perfil"),
					'thumb' => $imagen['raw_name']."_thumb".$imagen['file_ext'],
					'id_sitio' => $this->input->post("sitio") ,
					'tamano' => $imagen['file_size']
				);

				$this->Fotos->insert($data_insert);
				$this->session->set_flashdata("message",'<div class="alert alert-success">Imagen subida y agregada con exito</div>');
				redirect(site_url(uri_string()));
			}
		}

		$where = array(
			"rel_usuarios_sitios.id_usuario" => $this->uri->segment(3)
		);

		$data['sitios'] = $this->Rel_usuarios_sitios->select($where);
		$this->load->view("pictures/agregar",$data);
	}	

	public function fotos_sitios(){

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

		$this->load->model('Rel_fotos_sitios');

		if($this->input->post("send")){

			$this->Rel_fotos_sitios->delete($this->uri->segment(3));

			foreach($this->input->post("sitio") as $value){

				$data_insert = array(
					'id_foto' => $this->uri->segment(3) ,
					'id_sitio' => $value
				);
				$resp = $this->Rel_fotos_sitios->insert($data_insert);
			}
			$this->session->set_flashdata("message",'<div class="alert alert-success">Registro actualizado con exito</div>');
			redirect(site_url(uri_string()));

		}

		$data['rel_fotos'] = $this->Rel_fotos_sitios->select( array( "id_foto" => $this->uri->segment(3) ));
		$data['sitios'] = $this->Sitios->select();
		$this->load->view("admin/fotos_sitios",$data);

	}
}