<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Parametros extends MY_Model {

	public function select_paises( $id_pais = NULL , $where = array() ){

		$this->db->select();
		$this->db->from("paises");				
		$this->db->order_by("pais");
		$this->db->where($where);		

		if(is_numeric($id_pais)){
			$this->db->where("id_pais", $id_pais );
			$query = $this->db->get();				
			return $query->row_array();
		}else{
			$query = $this->db->get();		
			return $query->result_array();
		}	

	}

	public function insert_pais($insert_data){
		
		$this->db->insert("paises",$insert_data);
		$error = $this->db->error();		
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}	

	}

	public function select_sitios(){

		$this->db->select();
		$this->db->from("sitios");
		$this->db->where("estado",1);
		$this->db->order_by("nombre");
		$query = $this->db->get();
		return $query->result_array();

	}

	public function select_categorias(){

		$this->db->select();
		$this->db->from("categorias");
		$this->db->where("estado",1);
		$this->db->order_by("categoria");
		$query = $this->db->get();
		return $query->result_array();

	}

	public function select_roles($where){

		$this->db->select();
		$this->db->from("roles");
		$this->db->where($where);
		$this->db->order_by("rol");
		$query = $this->db->get();
		return $query->result_array();

	}

	public function select_regiones( $id_region = NULL , $where = array() ){

		$this->db->select();
		$this->db->from("regiones");				
		$this->db->order_by("region");
		$this->db->where($where);		

		if(is_numeric($id_region)){
			$this->db->where("id_region", $id_region );
			$query = $this->db->get();				
			return $query->row_array();
		}else{
			$query = $this->db->get();		
			return $query->result_array();
		}	

	}

	public function insert_region($insert_data){
		
		$this->db->insert("regiones",$insert_data);
		$error = $this->db->error();		
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}	

	}

	public function select_comunas( $id_comuna = NULL , $where = array() ){

		$this->db->select();
		$this->db->from("comunas");				
		$this->db->order_by("comuna");
		$this->db->where($where);		

		if(is_numeric($id_comuna)){
			$this->db->where("id_comuna", $id_comuna);
			$query = $this->db->get();				
			return $query->row_array();
		}else{
			$query = $this->db->get();		
			return $query->result_array();
		}	

	}

	public function select_formas_pago(){

		$this->db->select();
		$this->db->from("formas_pago");				
		$this->db->order_by("forma");
		$query = $this->db->get();
		return $query->result_array();	

	}

	public function insert_comuna($insert_data){
		
		$this->db->insert("comunas",$insert_data);
		$error = $this->db->error();		
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}
	}

	public function update_comuna( $id_comuna , $update_data){
		
		$this->db->where("id_comuna",$id_comuna);
		$this->db->update("comunas",$update_data);
		$error = $this->db->error();		
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}	

	}

	public function update_region( $id_region , $update_data){
		
		$this->db->where("id_region",$id_region);
		$this->db->update("regiones",$update_data);
		$error = $this->db->error();		
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}	

	}

	public function update_pais( $id_pais , $update_data){
		
		$this->db->where("id_pais",$id_pais);
		$this->db->update("paises",$update_data);
		$error = $this->db->error();		
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}	

	}


}
