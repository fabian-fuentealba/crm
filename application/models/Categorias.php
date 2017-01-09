<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categorias extends MY_Model {

	public function select( $data = array() , $is_array = TRUE ){

		$this->db->select();
		$this->db->from("categorias");
		$this->db->where($data);
		$this->db->order_by("categoria");
		$query = $this->db->get();
		if($is_array == TRUE){
			return $query->result_array();
		}else{
			return $query->row_array();
		}
	}

	public function count(){

		$this->db->select("categorias.categoria");
		$this->db->select("COUNT(categorias.categoria) AS cantidad");
		$this->db->from("categorias");
		$this->db->where("usuarios.estado" , 1 );
		$this->db->join("detalles","categorias.id_categoria = detalles.id_categoria");
		$this->db->join("usuarios","detalles.id_usuario = usuarios.id_usuario");
		$this->db->group_by("categorias.categoria");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function insert($data){

		$this->db->insert("categorias",$data);
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}
	}

	public function update( $id , $data ){

		$this->db->where( "id_categoria" , $id );
		$this->db->update( "categorias" , $data );		
		$error = $this->db->error(); //echo $this->db->last_query();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}
	}


}