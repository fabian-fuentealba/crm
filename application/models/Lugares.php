<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lugares extends MY_Model {

	public function insert($data){		
		
		$this->db->insert("lugares",$data);
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}
	}	

	public function select( $where = array() , $is_row = FALSE ){

		$this->db->select();
		$this->db->from("lugares");
		$this->db->where($where);		
		$this->db->order_by("lugar");
		$query = $this->db->get();
		if($is_row == TRUE ){
			return $query->row_array();
		}else{
			return $query->result_array();
		}
	}

	public function delete($where){		
		
		$this->db->where($where);
		$this->db->delete("lugares");		
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}
	}

	public function update( $id_lugar , $data ){		
		
		$this->db->where("id_lugar",$id_lugar);
		$this->db->update("lugares", $data);		
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}
	}

}