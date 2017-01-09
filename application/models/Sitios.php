<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitios extends MY_Model {	

	public function select($where = array()){

		$this->db->select();
		$this->db->from("sitios");
		$this->db->order_by("nombre");
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result_array();

	}	

}