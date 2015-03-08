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

    /**
     * Función para la paginación de resultados
     * @param  [type]  $url      [description]
     * @param  [type]  $total    [description]
     * @param  integer $segmento [description]
     * @return [type]            [description]
     */
    public function paginacion($url, $total, $segmento = 4) {
        $config['base_url'] = $url;
        $config['per_page'] = MAX_POR_PAG;
        $config['total_rows'] = $total;
        $config['uri_segment'] = $segmento;
        
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul><!--pagination-->';
        
        $config['first_link'] = 'Primero';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        
        $config['last_link'] = 'Último';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        
        $config['next_link'] = '&rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&larr;';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';

        //$config['anchor_class'] = 'follow_link';

        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    } 


}