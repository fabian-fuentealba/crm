<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cabellos extends MY_Model {	

	public function select($where = array()){

		$this->db->select();
		$this->db->from("cabellos");
		$this->db->order_by("cabello");
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result_array();

	}	

}