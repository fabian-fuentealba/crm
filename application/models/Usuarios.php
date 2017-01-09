<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends MY_Model {

	public function select( $where = array() , $is_row = FALSE , $like = array() , $all = FALSE ){

		$this->db->select("usuarios.id_usuario");
		$this->db->select("usuarios.nombre");
		$this->db->select("usuarios.id_rol");
		$this->db->select("usuarios.estado");
		$this->db->select("FLOOR(DATEDIFF(CAST(NOW() AS DATE ),usuarios.fecha_nacimiento)/365) AS edad");
		$this->db->select("usuarios.apellido");
		$this->db->select("usuarios.fecha_nacimiento");
		$this->db->select("usuarios.email");
		$this->db->select("usuarios.fijo");
		$this->db->select("usuarios.celular");
		$this->db->select("usuarios.sexo");
		$this->db->select("usuarios.id_pais");
		$this->db->select("usuarios.id_region");
		$this->db->select("usuarios.id_comuna");
		$this->db->select("usuarios.usuario");
		$this->db->select("detalles.posicion");
		$this->db->select("roles.rol");
		$this->db->from("usuarios");
		$this->db->join("detalles","detalles.id_usuario = usuarios.id_usuario","left");
		$this->db->join("roles","usuarios.id_rol = roles.id_rol");
		
		$this->db->where($where);
		$this->db->or_like($like);		
		$this->db->order_by("rol");
		$this->db->order_by("nombre");
		$query = $this->db->get(); //echo $this->db->last_query();
		
		if($is_row == TRUE ){
			return $query->row_array();
		}else{
			return $query->result_array();
		}

	}

	public function insert($insert_data){

		$this->db->set("creado","NOW()", FALSE);
		$this->db->set("id_creador",$this->session->userdata("id_usuario"));
		$this->db->set("actualizado","NOW()",FALSE);
		$this->db->set("estado",1);
		$this->db->insert("usuarios",$insert_data); //echo $this->db->last_query();
		$error = $this->db->error();
		if($error['code'] == 0){
			return $this->db->insert_id();
		}else{
			return $error['message'];
		}
	}

	public function update( $id_usuario , $update_data){

		$this->db->set("actualizado","NOW()");
		$this->db->set("id_actualizador" , $this->session->userdata("id_usuario") );
		$this->db->where("id_usuario",$id_usuario);
		$this->db->update("usuarios",$update_data);
		$error = $this->db->error();
		if($error['code'] == 0){
			return TRUE;
		}else{
			return $error['message'];
		}
	}

}
