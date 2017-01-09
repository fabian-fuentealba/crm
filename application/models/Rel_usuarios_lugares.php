<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rel_usuarios_lugares extends MY_Model {

	public function insert($data){		
		
		$this->db->insert("rel_usuarios_lugares",$data);
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}
	}

	public function select( $id_usuario ){

		$this->db->select("lugares.id_lugar");
		$this->db->select("lugares.lugar");
		$this->db->select("rel_usuarios_lugares.id_rel_usu_lug");
		$this->db->from("lugares");
		$this->db->join("rel_usuarios_lugares","lugares.id_lugar = rel_usuarios_lugares.id_lugar AND (rel_usuarios_lugares.id_usuario = $id_usuario )","left",FALSE);		
		$this->db->where("estado",1);
		$this->db->order_by("lugares.lugar");
		$query = $this->db->get();
		return $query->result_array();
	}	

	public function delete($where){		
		
		$this->db->where($where);
		$this->db->delete("rel_usuarios_lugares");		
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}
	}	

}