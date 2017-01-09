<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fotos extends MY_Model {

	public function insert($data){

		$this->db->set("creado","NOW()",FALSE);
		$this->db->set("id_creador",$this->session->userdata("id_usuario"));
		$this->db->insert("fotos",$data);
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}
	}

	public function select( $where , $is_row = FALSE){

		$this->db->select();
		$this->db->from("fotos");
		$this->db->join("sitios","fotos.id_sitio = sitios.id_sitio");
		$this->db->order_by("fotos.id_sitio");
		$this->db->order_by("es_perfil","desc"); 
		$this->db->order_by("creado","desc");
		$this->db->where($where);
		$query = $this->db->get();
		if($is_row == TRUE){
			return $query->row_array();
		}else{
			return $query->result_array();
		}

	}

	public function delete($data){

		$this->db->where($data);
		$this->db->delete("fotos");

	}

	public function update( $where = array() , $data  ){ 

		$this->db->where($where);
		$this->db->update("fotos",$data);
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}

	}

}