<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rel_formas_pago extends MY_Model {

	public function select($where){

		$this->db->select();
		$this->db->from("rel_usuario_forma_pago");
		$this->db->join("formas_pago","rel_usuario_forma_pago.id_forma_pago = formas_pago.id_forma_pago");
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result_array();	

	}

	public function insert($data){

		$this->db->insert("rel_usuario_forma_pago",$data);
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}

	}

	public function update($id_usuario ,$data){

		$this->db->where("id_usuario",$id_usuario);
		$this->db->update("detalles",$data);
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}

	}

}