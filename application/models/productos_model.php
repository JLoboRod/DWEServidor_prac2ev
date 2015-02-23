<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productos_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Lista todos los productos de la tienda
     * @return type
     */
    function listar_productos(){
        $query = $this->db->get('producto');
        return $query->result_array();
    }
    
    /**
     * Vende una cantidad $cant de unidades 
     * del producto $id
     * @param type $id
     * @param type $cant
     */
    function vender_producto($id, $cant){
        $this->db->where('id', $id);
        $datos = array('stock' => $cant);
        $this->db->update('producto', $datos);
    }
    
    /**
     * Busca productos por diversos criterios
     * recogidos en $datos
     * @param type $datos
     * @return type
     */
    function buscar_productos($datos){
        $this->db->where($datos);
        $query = $this->db->get('producto');
        return $query->result_array();
    }
    
    /**
     * Crea un nuevo producto
     * @param type $datos
     */
    function crear_producto($datos){
        $this->db->insert('producto', $datos);
    }
    
    /**
     * Edita los datos de un producto
     * @param type $id
     * @param type $datos
     */
    function editar_producto($id, $datos){
        $this->db->where('id', $id);
        $this->db->update('producto', $datos);
    }
    
    /**
     * Destaca el producto con id=$id
     * @param type $id
     */
    function destacar_producto($id){
        $datos = array(
            'destacado' => 1
        );
        $this->db->where('id', $id);
        $this->db->update('producto', $datos);
    }
    
}



