<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Detalles extends MY_Model {

	public function select($where){

		$this->db->select();
		$this->db->from("detalles");
		$this->db->join("categorias","detalles.id_categoria = categorias.id_categoria");
		$this->db->where($where);
		$query = $this->db->get();
		return $query->row_array();

	}

	public function insert($data){

		$this->db->insert("detalles",$data);
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