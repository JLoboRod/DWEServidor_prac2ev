<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidos_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Lista los pedidos
     * @return type
     */
    function listar_pedidos(){
        $query = $this->db->get('pedido');
        return $query->result_array();
    }
    
    /**
     * Busca pedidos por diversos criterios
     * recogidos en $datos
     * @param type $datos
     * @return type
     */
    function buscar_pedidos($datos){
        $this->db->where($datos);
        $query = $this->db->get('pedido');
        return $query->result_array();
    }
    
    /**
     * Crea un nuevo pedido
     * @param type $datos
     */
    function crear_pedido($datos){
        $this->db->insert('pedido', $datos);
    }
    
    
}



