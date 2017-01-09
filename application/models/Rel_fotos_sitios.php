<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rel_fotos_sitios extends MY_Model {

	public function insert($data){

		$this->db->set("creado","NOW()",FALSE);
		$this->db->set("id_creador",$this->session->userdata("id_usuario"));
		$this->db->insert("rel_fotos_sitios",$data);
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}
	}

	public function select( $where = array() ){

		$this->db->select();
		$this->db->from("rel_fotos_sitios");	
		$this->db->where($where);
		$query = $this->db->get();
		$data = array();
		foreach ($query->result_array() as $value) {
		 	$data[] = $value['id_sitio'];
		}

		return $data;

	}

	public function select_rel( $where = array() ){

		$this->db->select();
		$this->db->from("rel_fotos_sitios");	
		$this->db->join("sitios","rel_fotos_sitios.id_sitio = sitios.id_sitio");
		$this->db->where($where);
		$query = $this->db->get();
		$data = array();
		foreach ($query->result_array() as $value) {
		 	$data[] = $value['id_sitio'];
		}

		return $data;

	}

	public function delete($id_foto){

		$this->db->where("id_foto",$id_foto);
		$this->db->delete("rel_fotos_sitios");

	}	

}