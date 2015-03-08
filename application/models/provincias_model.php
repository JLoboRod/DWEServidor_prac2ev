<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Provincias_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Devuelve el nombre de una provincia con id=$id
     * @param type $id
     * @return string
     */
    function nombre_provincia($id){
        $this->db->where('id', $id);
        $query = $this->db->get('provincia');
        
        $reg= $query->row(); // row(): Devuelve el primer registro
        if ($reg)
            return $reg->nombre;
        else
            return '';
    }
    
      
    /**
     * Devuelve la lista de las provincias
     * indizadas por su id
     * @return array
     */
    function listar_provincias(){
        $query = $this->db->get('provincia');
        $lp = [];
        foreach ($query->result_array() as $row) {
            $lp[$row['id']] = $row['nombre'];
        }
        return $lp;    
    }
}


