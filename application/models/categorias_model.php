<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categorias_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Lista todos los productos de la tienda
     * @return type
     */
    function listar_categorias(){
        $query = $this->db->get('categoria');
        return $query->result_array();
    }
    
    /**
     * Crea una nueva categoría
     * @param type $datos
     */
    function crear_categoria($datos){
        $this->db->insert('categoria', $datos);
    }
    
    /**
     * Devuelve el nombre de una provincia con id=$id
     * @param type $id
     * @return string
     */
    function nombre_categoria($id){
        $this->db->where('id', $id);
        $query = $this->db->get('categoria');
        
        $reg= $query->row(); // row(): Devuelve el primer registro
        if ($reg)
            return $reg->nombre;
        else
            return '';
    }
    
    /**
     * Busca categorías por diversos criterios
     * recogidos en $datos
     * @param type $datos
     * @return type
     */
    function buscar_categorias($datos){
        $this->db->where($datos);
        $query = $this->db->get('categoria');
        return $query->result_array();
    }
}


