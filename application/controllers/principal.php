<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Principal extends My_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('productos_model');
    }
    
    function index(){
        //redirect(base_url('index.php/clientes/registrar'), 'refresh');        
        $this->mostrar_destacados();
        //$anuncio = $this->load->view('anuncio', 0, TRUE);
        //$this->plantilla($anuncio);
    }

    private function prueba_form_reg(){
        $data['encabezado'] = $this->load->view('encabezado', 0, TRUE);
        $data['provincias'] = $this->provincias_model->listar_nombres_provincias();
        $data['cuerpo'] = $this->load->view('formulario_registro', $data, TRUE);
        $data['pie'] = $this->load->view('pie', 0, TRUE);
        $this->load->view('plantilla', $data);
    } 

    private function prueba_plantilla(){
        
        
        $data['titulo'] = 'Principal';
        $data['titulo_cuerpo'] = 'Párrafo Lorem Ipsum';
        $data['html_encabezado'] = $this->load->view('encabezado', 0, TRUE);
        $data['html_menu'] = $this->load->view('menu', 0, TRUE);
        $data['html_cuerpo'] = $this->load->view('anuncio', 0, TRUE);
        $data['html_cuerpo'] .=$this->load->view('cuerpo', $data, TRUE);
        $data['html_pie'] = $this->load->view('pie', 0, TRUE);
        $this->load->view('plantilla', $data);
        

    }
    
    function mostrar_destacados(){
        $productos = $this->productos_model->buscar_productos(array('destacado' => '1'));

        $anuncio = $this->load->view('anuncio', 0, TRUE);
        $lista = $this->load->view('lista_productos', array(
            'productos' => $productos
            ), TRUE);

        $this->plantilla($anuncio.$lista);   
    }
    
    
    
    
    
    
}

