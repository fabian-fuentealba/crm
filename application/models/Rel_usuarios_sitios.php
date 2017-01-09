<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rel_usuarios_sitios extends MY_Model {

	public function insert($data){

		$this->db->set("creado","NOW()",FALSE);
		$this->db->insert("rel_usuarios_sitios",$data);
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}
	}

	public function select($where){

		$this->db->select();
		$this->db->from("rel_usuarios_sitios");	
		$this->db->join("sitios","rel_usuarios_sitios.id_sitio = sitios.id_sitio");
		$this->db->where($where);
		$query = $this->db->get();		
		return $query->result_array();

	}

	public function delete($id_usuario){

		$this->db->where("id_usuario",$id_usuario);
		$this->db->delete("rel_usuarios_sitios");
	}

}