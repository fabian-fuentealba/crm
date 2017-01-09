<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Horarios extends MY_Model {

	public function insert($data){

		$this->db->set("creado","NOW()",FALSE);
		$this->db->set( 'id_creador' , $this->session->userdata("id_usuario") );
		$this->db->insert("horarios",$data);
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}
	}

	public function select( $where = array() ){

		$this->db->select();
		$this->db->from("horarios");		
		$this->db->where($where);
		$query = $this->db->get();
		$data = array();
		foreach ( $query->result_array() as $key => $value) {
		 	
		 	$data[$value['dia']]['desde'] = $value['desde'];
		 	$data[$value['dia']]['hasta'] = $value['hasta'];
		}

		return $data ;	

	}

	public function delete($id_usuario){

		$this->db->where("id_usuario",$id_usuario);
		$this->db->delete("horarios");
	}

}