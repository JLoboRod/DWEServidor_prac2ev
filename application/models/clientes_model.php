<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientes_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Lista los clientes registrados en la base de datos
     * @return type
     */
    function listar_clientes(){
        $query = $this->db->get('cliente');
        
        return $query->result_array();
    }
    
    /**
     * Lista los clientes activos
     * @return type
     */
    function listar_clientes_activos(){
        $this->db->where('activo', 1);
        $query = $this->db->get('cliente');
        
        return $query->result_array();
    }
    
    /**
     * Crea un nuevo cliente
     * @param type $datos
     */
    function crear_cliente($datos){
        $this->db->insert('cliente', $datos);
    }
    
    /**
     * Da de baja el cliente con id=$id
     * pero no lo elimina
     * @param type $id
     */
    function baja_cliente($id){
        $datos = array(
            'activo' => 0
        );
        $this->db->where('id', $id);
        $this->db->update('cliente', $datos);
    }
    
    /**
     * Elimina el cliente con id=$id
     * @param type $id
     */
    function eliminar_cliente($id){
        $this->db->where('id', $id);
        $this->db->delete('cliente');
    }
    
    /**
     * Edita los datos del cliente con id=$id
     * actualizando sus datos con $datos
     * @param type $id
     * @param type $datos
     */
    function editar_cliente($id, $datos){
        $this->db->where('id', $id);
        $this->db->update('cliente', $datos);
    }
    
    /**
     * Busca clientes por diversos criterios
     * recogidos en $datos
     * @param type $datos
     * @return type
     */
    function buscar_clientes($datos){
        $this->db->where($datos);
        $query = $this->db->get('cliente');
        
        //$query = $this->db->get_where('cliente', $datos);
        return $query->result_array();
    }
}


