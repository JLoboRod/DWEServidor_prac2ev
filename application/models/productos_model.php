<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productos_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function num_productos_destacados() {
        $this->db->from('producto');
        $where = '(fecha_ini_dest < '.date("Y-m-d").' AND fecha_fin_dest > '.date("Y-m-d").') OR ';
        $where.= '(fecha_ini_dest is null AND fecha_fin_dest is null AND destacado like "1")';
        $this->db->where($where);

        $resultado = $this->db->get();

        return $resultado->num_rows();
    }

    function num_productos_categoria($cat) {
        $this->db->from('producto');
        $this->db->where(array('categoria_id' => $cat));

        $resultado = $this->db->get();

        return $resultado->num_rows();
    }

    function num_productos(){
        $this->db->from('producto');
        $resultado = $this->db->get();

        return $resultado->num_rows();
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

    function get_producto($id){
        $this->db->where(array('id'=>$id));
        $query = $this->db->get('producto');
        return $query->row_array();
    }

    function listar_destacados($pag = 0, $max_por_pag = MAX_POR_PAG) {
        $this->db->limit($max_por_pag, $pag);

        $this->db->from('producto');
        $where = '(fecha_ini_dest < '.date("Y-m-d").' AND fecha_fin_dest > '.date("Y-m-d").') OR ';
        $where.= '(fecha_ini_dest is null AND fecha_fin_dest is null AND destacado like "1")';
        $this->db->where($where);

        $resultado = $this->db->get();
        return $resultado->result_array();
    }

    function listar_productos_categoria($cat, $pag = 0, $max_por_pag = MAX_POR_PAG) {
        $this->db->limit($max_por_pag, $pag);

        $this->db->from('producto');
        $this->db->where(array('categoria_id' => $cat));

        $resultado = $this->db->get();
        return $resultado->result_array();
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

    /**
     * Devuelve el stock de un producto
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    function get_stock($id){
        $this->db->select('stock');
        $this->db->where('id', $id);
        return $this->db->get('producto')->row_array()['stock'];
    }

    /**
     * Establece un stock al producto
     * @param [type] $id    [description]
     * @param [type] $stock [description]
     */
    function set_stock($id, $stock){
        $this->db->where('id', $id);
        $this->db->update('producto', array(
            'stock' => $stock
            ));
    }
    
}



