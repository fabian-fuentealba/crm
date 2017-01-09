<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configs extends Logged {

	public function __construct(){

		parent::__construct();	
		$this->load->library('form_validation');
		$this->load->model(array('Usuarios','Parametros','Detalles','Tarifas','Fotos','Planes','Sitios','Contactos','Rel_usuarios_servicio','Rel_usuarios_lugares','Rel_usuarios_sitios'));

	}

	public function index(){

		$this->load->js('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js');
		$this->load->js('assets/js/charts.js');
		$this->load->model(array('Categorias','Visitas'));
		$data['categorias'] = $this->Categorias->count();
		$data['visitas'] = $this->Visitas->select();
		$this->load->view('admin/index',$data);
	}