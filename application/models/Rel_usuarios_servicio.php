<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rel_usuarios_servicio extends MY_Model {

	public function insert($data){		
		
		$this->db->set("creado","now()",FALSE);
		$this->db->insert("rel_usuarios_servicios",$data);
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}
	}

	public function select( $id_usuario ){

		$this->db->select("servicios.id_servicio");
		$this->db->select("servicios.servicio");
		$this->db->select("rel_usuarios_servicios.normal");
		$this->db->select("rel_usuarios_servicios.adicional");
		$this->db->select("rel_usuarios_servicios.id_rel_usu_ser");
		$this->db->from("servicios");
		$this->db->join("rel_usuarios_servicios","servicios.id_servicio = rel_usuarios_servicios.id_servicio AND (rel_usuarios_servicios.id_usuario = $id_usuario )","left",FALSE);		
		$this->db->where("estado",1);
		$this->db->order_by("servicios.servicio");
		$query = $this->db->get();
		return $query->result_array();
	}	

	public function delete($where){		
		
		$this->db->where($where);
		$this->db->delete("rel_usuarios_servicios");		
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}
	}	

}