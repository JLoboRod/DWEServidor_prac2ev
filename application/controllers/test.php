<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('provincias_model');
        $this->load->model('clientes_model');
    }
    
    public function index() {
        $datos['provincias'] = $this->provincias_model->listar_provincias();
        $this->load->view('test', $datos);
    }
    
    public function provincia($id){
        $datos['provincia'] = $this->provincias_model->nombre_provincia('01');
        $this->load->view('test', $datos);
    }
    
    public function clientes(){
        $datos['clientes'] = $this->clientes_model->listar_clientes();
        $this->load->view('test', $datos);
    }
    
    public function registrar_cliente(){
        
        //En principio hemos utilizado estos datos de prueba pero esto
        //deberia venir de un formulario con los datos filtrados
        $datos = array(
            'usuario' => 'prueba',
            'password' => 'prueba',
            'email' => 'prueba@prueba.com',
            'nombre' => 'prueba',
            'apellidos' => 'prueba prueba',
            'dni' => '45839220B',
            'direccion' => 'dirección de prueba',
            'cod_postal' => '123456',
            'provincia_id' => '21'
        );
        
        $this->clientes_model->crear_cliente($datos);
    }
    
    /**
     * Da de baja un cliente: NO LO ELIMINA
     */
    public function baja_cliente($id){
        $this->clientes_model->baja_cliente($id);
    }
    
    /**
     * Elimina un cliente de la base de datos
     * @param type $id
     */
    public function eliminar_cliente($id){
        $this->clientes_model->eliminar_cliente($id);
    }
    
    public function buscar_clientes(){
        $criterios = array(
            'usuario'=> 'admin',
            'nombre' => 'administrador'
        );
        $datos['clientes'] = $this->clientes_model->buscar_clientes($criterios);
        $this->load->view('test', $datos);
    }
    
    
    
}



