<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidos extends My_Controller {

    public function __construct() {
        parent::__construct();
    
        $this->load->model('pedidos_model');
    }
    
    function index(){
        
    }
    
}
