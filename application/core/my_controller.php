<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class My_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('categorias_model');
    }

    /**
     * Carga la plantilla html (encabezado, menu, cuerpo y pie).
     * @param unknown $cuerpo
     */
    protected function plantilla($cuerpo)
    {
        $categorias = $this->categorias_model->listar_categorias();
        //Carga del encabezado
        $encabezado = $this->load->view('encabezado', array('categorias' => $categorias), TRUE);
        $pie = $this->load->view('pie', 0, TRUE);
        
        //Creo una plantilla con los apartados a mostrar
        $this->load->view('plantilla', array(
            'encabezado' => $encabezado,
            'cuerpo' => $cuerpo,
            'pie' => $pie
            ));
    }


}