<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Principal extends My_Controller {

    

    public function __construct() {
        parent::__construct();
        $this->load->model('productos_model');
        $this->load->model('categorias_model');
    }
    

    function index($pag = 0){ //Especificamos la página para la paginación
        $this->mostrar_destacados($pag);
    }

    /**
     * Muestra los productos destacados
     * @param  integer $pag [description]
     * @return [type]       [description]
     */
    function mostrar_destacados($pag = 0){
        $productos = $this->productos_model->listar_destacados($pag);
        $productos = $this->nombrar_categorias($productos);
        $datos = "<h1>Productos destacados</h1>";
        $anuncio = $this->load->view('anuncio', array(
            'datos_anuncio' => $datos
            ), TRUE);
        $paginador = $this->paginacion(site_url("principal/index/"), $this->productos_model->num_productos_destacados(), 3);
        
        $lista = $this->load->view('lista_productos', array(
            'productos' => $productos
            ), TRUE);
        $this->plantilla($anuncio.$paginador.$lista);   
    }


    /**
     * Muestra los productos de una categoría
     * @param  [type] $cat [description]
     * @return [type]      [description]
     */
    function mostrar_productos_categoria($cat){
        $datos_categoria = $this->categorias_model->buscar_categoria(array('nombre' => urldecode($cat)));

        if($datos_categoria){
            $productos = $this->productos_model->buscar_productos(array('categoria_id' => $datos_categoria['id']));
            $productos = $this->nombrar_categorias($productos);
            $anuncio = $this->load->view('anuncio', array('datos_anuncio' => $datos_categoria['anuncio']), TRUE);
            $lista = $this->load->view('lista_productos', array(
                'productos' => $productos
                ), TRUE);

            $this->plantilla($anuncio.$lista);   
        }
        else{
            $this->plantilla($this->load->view('mensaje', array(
                'mensaje' => 'Categoría no disponible'
                ), TRUE));
        }  
    }

    /**
     * Trata la búsqueda de productos
     * @return [type] [description]
     */
    function buscar_productos(){

        if($this->input->post('busqueda')){
            $productos = $this->productos_model->buscar_productos(array('nombre' => $this->input->post('busqueda')));
            if($productos){
               $productos = $this->nombrar_categorias($productos);

               $lista = $this->load->view('lista_productos', array(
                'productos' => $productos
                ), TRUE);

               $this->plantilla($lista); 
           }
           else{
            $this->plantilla($this->load->view('mensaje', array(
                'mensaje' => 'No se encontraron resultados'
                ), TRUE));
            }

        }
    }

    /**
     * Añade el nombre de categoría a una lista
     * de productos
     * @param  [type] $prods [description]
     * @return [type]        [description]
     */
    private function nombrar_categorias($prods){

        for ($i=0; $i < count($prods) ; $i++) { 
            $prods[$i]['categoria'] = $this->categorias_model->nombre_categoria($prods[$i]['categoria_id']);
        }

        return $prods;
    }


    
    
    
    
    
    
}

