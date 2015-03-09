<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lineas_pedido_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Lista las lineas de pedidos
     * @return type
     */
    function listar_linea_pedido(){
        $query = $this->db->get('linea_pedido');
        return $query->result_array();
    }
    
    /**
     * Busca lineas de pedido por diversos criterios
     * recogidos en $datos
     * @param type $datos
     * @return type
     */
    function buscar_linea_pedido($datos){
        $this->db->where($datos);
        $query = $this->db->get('linea_pedido');
        return $query->result_array();
    }
    
    /**
     * Crea un nuevo linea_linea_pedido
     * @param type $datos
     */
    function crear_linea_pedido($datos){
        $this->db->insert('linea_pedido', $datos);
    }
    
    
}





