<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Servicios extends MY_Model {

	public function insert($data){			

		$this->db->insert("servicios",$data);
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}
	}	

	public function select( $where = array() , $is_row = FALSE ){

		$this->db->select();
		$this->db->from("servicios");
		$this->db->where($where);		
		$this->db->order_by("servicio");
		$query = $this->db->get();
		if($is_row == TRUE ){
			return $query->row_array();
		}else{
			return $query->result_array();
		}
	}

	public function delete($where){		
		
		$this->db->where($where);
		$this->db->delete("servicios");		
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}
	}

	public function update( $id_servicio , $data ){		
		
		$this->db->where("id_servicio",$id_servicio);
		$this->db->update("servicios", $data);		
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}
	}

}