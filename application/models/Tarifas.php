<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tarifas extends MY_Model {

	public function insert($data){

		$this->db->insert("tarifas",$data);
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}
	}

	public function select( $where , $rows = FALSE ){

		$this->db->select();
		$this->db->from("tarifas");
		$this->db->order_by("ahora");
		$this->db->where($where);
		$query = $this->db->get();
		if( $rows == TRUE ){
			return $query->num_rows();
		}else{
			return $query->result_array();
		}	

	}

	public function delete($id_tarifa){

		$this->db->where("id_tarifa",$id_tarifa);
		$this->db->delete("tarifas");
	}

}