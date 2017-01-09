<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contexturas extends MY_Model {	

	public function select($where = array()){

		$this->db->select();
		$this->db->from("contexturas");
		$this->db->order_by("contextura");
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result_array();

	}	

}