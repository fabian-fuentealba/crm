<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contratos extends MY_Model {

	public function insert($data){

		$this->db->set("creado","NOW()", FALSE);
		$this->db->set("id_creador",$this->session->userdata("id_usuario"));
		$this->db->insert("contratos",$data);
		$error = $this->db->error();
		if($error['code'] == 0){
			return $this->db->insert_id();
		}else{
			return $error['message'];
		}
	}

	public function select( $where = array() , $is_row = FALSE ){

		$this->db->select("contratos.id_contrato");
		$this->db->select("planes.plan");
		$this->db->select("contratos.desde");
		$this->db->select("contratos.hasta");
		$this->db->select("contratos.valor");
		$this->db->select("contratos.creado");
		$this->db->select("usuarios.usuario");
		$this->db->select("DATEDIFF(contratos.hasta, contratos.desde) AS duracion",FALSE);
		$this->db->select("IF(DATEDIFF(contratos.hasta, CAST(NOW() as DATE)) > 0 , DATEDIFF(contratos.hasta, CAST(NOW() as DATE)) , '<span class=\"label label-danger\">Vencido</span>') AS quedan",FALSE);
		$this->db->from("contratos");
		$this->db->join("planes","contratos.id_plan = planes.id_plan");
		$this->db->join("usuarios","contratos.id_creador = usuarios.id_usuario");
		$this->db->where($where);
		$this->db->order_by("creado","desc");		
		$query = $this->db->get();
		if($is_row == FALSE){
			return $query->result_array();
		}else{
			return $query->row_array();
		}	

	}

	public function delete($id_contrato){

		$this->db->where("id_contrato",$id_contrato);
		$this->db->delete("contratos");
	}

}