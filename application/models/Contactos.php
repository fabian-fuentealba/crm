<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contactos extends MY_Model {

    public function select( $where = array() , $is_row = FALSE){

        $this->db->select("contactos.id_contacto");
        $this->db->select("contactos.nombre");
        $this->db->select("contactos.telefono");
        $this->db->select("contactos.correo");
        $this->db->select("contactos.creado");
        $this->db->select("contactos.mensaje");
        $this->db->select("categorias.categoria");
        $this->db->select("sitios.nombre AS sitio");
        $this->db->from("contactos");
        $this->db->join("sitios","contactos.id_sitio = sitios.id_sitio","left");
        $this->db->join("categorias","contactos.id_categoria = categorias.id_categoria","left");
        $this->db->order_by("contactos.creado","desc");
        $this->db->where($where);
        $query = $this->db->get(); //echo $this->db->last_query();
        if($is_row == TRUE ){
                   return $query->row_array();
            }else{
                   return $query->result_array();
            }

    }

}
