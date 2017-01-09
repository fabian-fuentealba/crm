<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Visitas extends MY_Model {

	public function select(){

		$this->db->select("COUNT(*) AS visitas");
		$this->db->select("detalles.alias");
		$this->db->select("categorias.categoria");
		$this->db->from("visitas_detalle");		
		$this->db->join("detalles","visitas_detalle.id_usuario = detalles.id_usuario");
		$this->db->join("categorias","detalles.id_categoria = categorias.id_categoria");
		$this->db->group_by("detalles.alias");
		$this->db->order_by("visitas","desc");
		$this->db->limit(10);
		$query = $this->db->get(); //echo $this->db->last_query();
		return $query->result_array();
	}
	
}