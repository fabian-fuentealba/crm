<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Planes extends MY_Model {

	public function insert($data){

		$this->db->set("creado","NOW()",FALSE);
		$this->db->set("id_creador",$this->session->userdata("id_usuario"));
		$this->db->insert("planes",$data);
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}
	}

	public function update( $id_plan  , $data ){

		$this->db->set("actualizado","NOW()",FALSE);
		$this->db->set("id_actualizador",$this->session->userdata("id_usuario"));
		$this->db->update("planes",$data);
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}
	}

	public function select($where = array() , $is_row = FALSE ){

		$this->db->select();
		$this->db->from("planes");
		$this->db->order_by("lugar");
		$this->db->where($where);
		$query = $this->db->get();
		if($is_row == FALSE){
			return $query->result_array();
		}else{
			return $query->row_array();
		}		

	}

	public function delete($id_plan){

		$this->db->where("id_plan",$id_plan);
		$this->db->delete("planes");
	}

}