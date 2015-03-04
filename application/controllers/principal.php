<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Principal extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    function index(){
        $data['titulo'] = 'Principal';
        $data['titulo_cuerpo'] = 'Párrafo Lorem Ipsum';
        $data['html_encabezado'] = $this->load->view('encabezado', 0, TRUE);
        $data['html_menu'] = $this->load->view('menu', 0, TRUE);
        $data['html_cuerpo'] = $this->load->view('anuncio', 0, TRUE);
        $data['html_cuerpo'] .=$this->load->view('cuerpo', 0, TRUE);
        $data['html_pie'] = $this->load->view('pie', 0, TRUE);
        $this->load->view('plantilla', $data);
    }
}

