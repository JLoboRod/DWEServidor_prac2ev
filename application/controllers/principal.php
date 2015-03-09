<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once __DIR__.'/my_controller.php';

class Principal extends My_Controller {



    public function __construct() {
        parent::__construct();
        $this->load->library('my_pdf');
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
        $productos = $this->preparar_fechas($productos);
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
    function mostrar_categoria($cat, $pag=0){
        $datos_categoria = $this->categorias_model->buscar_categoria(array('nombre' => urldecode($cat)));

        if($datos_categoria){
            $productos = $this->productos_model->listar_productos_categoria($datos_categoria['id'], $pag);
            $productos = $this->nombrar_categorias($productos);
            $productos = $this->preparar_fechas($productos);
            $anuncio = $this->load->view('anuncio', array('datos_anuncio' => $datos_categoria['anuncio']), TRUE);
            $lista = $this->load->view('lista_productos', array(
                'productos' => $productos
                ), TRUE);

            $paginador = $this->paginacion(site_url('principal/mostrar_categoria/'.$cat.'/'), $this->productos_model->num_productos_categoria($datos_categoria['id']), 4);
            
            $debug = $this->load->view('debug', array('productos' => $productos), TRUE);
            $lista = $this->load->view('lista_productos', array(
                'productos' => $productos
                ), TRUE);
            $this->plantilla($anuncio.$paginador.$lista);    
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

    /**
     * Prepara las fechas para su presentación
     * @param  [type] $prods [description]
     * @return [type]        [description]
     */
    private function preparar_fechas($prods){
        for ($i=0; $i < count($prods) ; $i++) { 
            $prods[$i]['fecha_ini_dest'] = join('/', array_reverse(explode('-',$prods[$i]['fecha_ini_dest'])));
            $prods[$i]['fecha_fin_dest'] = join('/', array_reverse(explode('-',$prods[$i]['fecha_ini_dest'])));
        }  
        return $prods;
    }
    
    /**
     * Muestra el contenido del carrito
     */
    function mostrar_carrito()
    {
        if($this->input->post())  //Modifico las cantidades de los articulos
        {
            foreach ($this->input->post() as $id=>$cantidad)
            {
                $data[]=array(
                    'rowid'=>$id,
                    'qty'=>$cantidad
                    );
            }
            $this->cart->update($data);
        }
        $datos['articulos']=$this->cart->contents();
        $datos['total']=$this->cart->total();
        $carrito = $this->load->view('carrito', $datos, TRUE);
        
        if($this->session->flashdata('carrito_vacio')){
            $mensaje = $this->load->view('mensaje_error', array(
                'mensaje' => $this->session->flashdata('carrito_vacio')
                ), TRUE);
            $this->plantilla($mensaje.$carrito);
        }
        else if($this->session->flashdata('stock')){
            $mensaje = $this->load->view('mensaje_error', array(
                'mensaje' => $this->session->flashdata('stock')
                ), TRUE);
            $this->plantilla($mensaje.$carrito);
        }
        else{
            $this->plantilla($carrito);
        }

        
        
    }
    
    
    /**
     * Añade un producto al carrito
     */
    public function agregar_producto()
    {
        $id_producto = $this->input->post('id_producto');
        var_dump($this->input->post('id_producto'));
        $producto = $this->productos_model->get_producto($id_producto);
        $cantidad =  $this->input->post('cantidad');
        $carrito = $this->cart->contents();
        foreach ($carrito as $item) {           //si el id del producto es igual que uno que ya
            if ($item['id'] == $id_producto) {  //tengamos en la cesta le sumamos la cantidad
                $cantidad+=$item['qty'];
                break;
            }
        }
        $datos = array(
            'id' => $id_producto,
            'qty' => $cantidad,
            'price' => $producto['precio_venta'],
            'name' => $producto['nombre'],
            'stock'=>$producto['stock'],
            'descuento' => $producto['descuento'],
            'precio_final' => $this->calcular_precio($producto['precio_venta'], $producto['descuento'])
            );
        $this->cart->insert($datos);
        $this->session->set_flashdata('agregado', 'El producto fue agregado correctamente');
        //redirect(site_url(),'refresh');
        redirect($this->input->post('url'));
    }

    public function vaciar_carrito(){
        $this->cart->destroy();

        redirect(site_url("principal/mostrar_carrito"));
    }

    /**
     * Validar el proceso de compra
     * @return [type] [description]
     */
    public function procesar_compra(){

        if(!$this->session->userdata('usuario')){
            $this->session->set_flashdata('comprar', 'Debe loguearse para continuar con el proceso de compra');
            redirect(site_url('clientes/acceder'));
        }
        else{
            //Comprobamos si el carrito esta vacío
            if($this->cart->total_items()== 0){
                $this->session->set_flashdata('carrito_vacio', 'El carrito está vacío.');
                redirect(site_url('principal/mostrar_carrito'));
            }
            else if(count($productos_sin_stock = $this->comprobar_stock_carrito()) > 0) {
                $this->session->set_flashdata('stock', 'No hay stock de los siguientes productos '.implode(", ",$productos_sin_stock));
                redirect(site_url('principal/mostrar_carrito'));
            }
            else{


                if($this->input->post('resumen_compra')){

                //Array con los datos de pedido
                    $cliente = $this->clientes_model->buscar_cliente_por_usuario($this->session->userdata('usuario'));
                    $datos_pedido=array(
                        'cliente_id'=>$cliente['id'],
                        'nombre'=>$cliente['nombre'],
                        'apellidos'=>$cliente['apellidos'],
                        'email'=>$cliente['email'],
                        'dni'=>$cliente['dni'],
                        'direccion'=>$cliente['direccion'],
                        'provincia' => $cliente['provincia_id'],
                        'cod_postal'=>$cliente['cod_postal'],
                        'cantidad'=> $this->cart->total_items(),
                        'importe'=>$this->cart->total(),
                        'fecha_pedido'=>date('Y-m-d')
                        );

                //Añadimos el pedido
                    $this->pedidos_model->crear_pedido($datos_pedido);
                    $id_pedido = $this->db->insert_id();
                    foreach ($this->cart->contents() as $articulo)
                    {
                        $datosLinea=array(
                            'producto_id'=>$articulo['id'],
                            'pedido_id'=>$id_pedido,
                            'cantidad'=>$articulo['qty'],
                            'precio_venta'=>$articulo['price'],
                            'descuento'=>$articulo['descuento'],
                            'iva' => 21
                            );
                        $stock = $this->productos_model->get_stock($articulo['id']);
                        $stock -= $articulo['qty'];
                        $this->productos_model->set_stock($articulo['id'], $stock);
                        $this->lineas_pedido_model->crear_linea_pedido($datosLinea);
                    }

                    $this->cart->destroy(); //Limpiamos el carrito
                    //redirect(BASEURL.'index.php/pedido/factura/'.$idPedido);
                    $this->generar_factura($id_pedido);
                    if($this->mandar_mail_pedido($id_pedido)){
                        $this->session->set_flashdata('correo_exito','Su pedido se ha realizado correctamente. Se envió la factura a su correo.');

                    }
                    else{
                        $this->session->set_flashdata('correo_error','Hubo algún error al enviar la factura.');
                    }

                    redirect(site_url('clientes/listar_pedidos'));
                }
                else{
                    //Vamos a mostrar el resumen de la compra
                    $mensaje = $this->load->view('mensaje', array(
                        'mensaje' => 'A continuación se le mandará una factura a su correo electrónico'
                        ), TRUE);

                    $resumen = $this->load->view('vista_resumen', array(
                        'productos' => $this->cart->contents(),
                        'total' => $this->cart->total()
                        ), TRUE);

                    $this->plantilla($mensaje.$resumen);
                }
            }   
        }

    }


    /**
     * Manda un email con el detalle el pedido
     * @param  [type] $id_pedido [description]
     * @return [type]            [description]
     */
    public function mandar_mail_pedido($id_pedido){
        //Buscamos el pedido
        $pedido=$this->pedidos_model->get_pedido($id_pedido);
        
        // Utilizando smtp
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'mail.iessansebastian.com';
        $config['smtp_user'] = 'aula4@iessansebastian.com';
        $config['smtp_pass'] = 'daw2alumno';

        $this->email->initialize($config);

        $this->email->from('jloborod@gmail.com', 'Prueba Automática desde CI');
        $this->email->to($pedido['email']);
        $this->email->cc('jloborod@gmail.com');
        $this->email->subject('Factura Pedido '.$id_pedido);
        $this->email->message('Gracias por su compra.');
        if(file_exists(RUTA_PDF.'fact_'.$id_pedido.'.pdf')){
            $this->email->attach(RUTA_PDF.'fact_'.$id_pedido.'.pdf');
            return $this->email->send();
        }
        else{
            $this->session->set_flashdata('factura', 'No se encuentra la factura');
        }
        
    }

    /**
     * Genera una factura en formato pdf de un
     * pedido concreto
     * @param  [type] $idPedido [description]
     * @param  [type] $accion   [description]
     * @return [type]           [description]
     */
    public function generar_factura($id_pedido)
    {
        //Buscamos el pedido
        $pedido=$this->pedidos_model->get_pedido($id_pedido);

        //Codificamos los campos a utf-8
        foreach ($pedido as $clave => $valor) {
            $pedido[$clave] = utf8_decode($valor);
        }

        $linea_pedido = $this->lineas_pedido_model->buscar_linea_pedido(array(
            'pedido_id' => $pedido['id']
            ));



        $this->pdf= new My_pdf();
        $this->pdf->AddPage();
        $this->pdf->AliasNbPages();
        
        $this->pdf->SetTitle("Factura");
        $this->pdf->SetLeftMargin(15);
        $this->pdf->SetRightMargin(15);
        $this->pdf->SetFillColor(200,200,200);

        // Se define el formato de fuente: Arial, negritas, tamaño 9
        $this->pdf->SetFont('Arial', 'B', 9);
        

        $this->pdf->Cell(30);
        $this->pdf->Cell(120,10,'DATOS DEL PEDIDO',0,0,'C');
        $this->pdf->Ln(12);


        /*
         * $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
         */
        
        foreach ($pedido as $key => $value) {
            $this->pdf->Cell(30);
            $this->pdf->Cell(38,7, $key,'TBL',0,'L','1');
            $this->pdf->Cell(50,7, $value,'TBLR',0,'L','1');
            $this->pdf->Ln(7);
        }

        $this->pdf->Ln(7);

        $this->pdf->Cell(30);
        $this->pdf->Cell(120,10,'DATOS LINEA DE PEDIDO',0,0,'C');
        $this->pdf->Ln(12);

        
        foreach ($linea_pedido as $i => $linea) {
            $linea_pedido[$i]['nombre_producto'] = utf8_decode($this->productos_model->get_producto($linea['producto_id'])['nombre']);
        }
        

        foreach ($linea_pedido as $linea) {
            foreach ($linea as $key => $value) {
                $this->pdf->Cell(30);
                $this->pdf->Cell(38,7, $key,'TBL',0,'L','1');
                $this->pdf->Cell(50,7, $value,'TBLR',0,'L','1');
                $this->pdf->Ln(7);
            }

            $this->pdf->Ln(7);
        }

        
        //Podemos mostrar con I, descargar con D, o guardar con F
        //$this->pdf->Output($pedido['id'].".pdf", 'I');
        //$this->pdf->Output("Lista de provincias.pdf", 'D');
        $this->pdf->Output(APPPATH."../pdf/fact_".$pedido['id'].".pdf", 'F');
    }

    /**
     * Calcula el precio final dado el precio de venta
     * y el descuento
     * @param  [type]  $precio [description]
     * @param  integer $desc   [description]
     * @return [type]          [description]
     */
    private function calcular_precio($precio, $desc=0){
        return floatval($precio - ($precio*$desc/100));
    }

    /**
     * Comprueba el stock de los productos del carrito
     * devolviendo un array con los productos que no
     * tienen stock suficientes
     * @return [type] [description]
     */
    private function comprobar_stock_carrito(){
        $productos = [];
        $articulos = $this->cart->contents();


        foreach ($articulos as $articulo) {
            if($articulo['qty'] > $this->productos_model->get_stock($articulo['id'])){ //No hay stock suficiente
                array_push($productos, $articulo['name']);
            }
        }
        return $productos;
    }



}










