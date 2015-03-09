<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once __DIR__.'/my_controller.php';

class Clientes extends My_Controller {

    public function __construct() {
        parent::__construct();

        //Mensajes de validación de nuestras callbacks
        //%s es el nombre del campo que tiene errores
        $this->form_validation->set_message('valid_dni', 'El Dni introducido no es válido');
    }
    
    function index(){

    }

    /**
     * Acceso a la aplicación
     * @return [type] [description]
     */
    function acceder(){
        //Seteamos reglas de validación para el login
        $this->form_validation->set_rules('usuario', 'Usuario', 'required|min_length[3]|max_length[45]|trim|xss_clean');
        $this->form_validation->set_rules('password', 'Contraseña', 'trim|required|md5');
        
        if ($this->form_validation->run() == TRUE)
        {
            $usuario = $this->input->post('usuario');
            $password = $this->input->post('password');
            if($this->login_correcto($usuario, $password) && !$this->esta_de_baja($usuario))
            {       
                //Añade usuario a la session y lo redirige según este comprando o no
                $this->session->set_userdata('usuario', $usuario);
                if(!$this->session->userdata('comprar')){
                    redirect(site_url());        
                }
                else{
                    redirect(site_url('principal/mostrar_carrito'));
                }        
            }
            else
            {
                $formulario = $this->load->view('formulario_acceso', 0, TRUE);
                $mensaje = $this->load->view('mensaje_error', array(
                    'mensaje' => 'Datos erróneos. Por favor, inténtelo otra vez.' 
                    ), TRUE);
                $this->plantilla($mensaje.$formulario);
            }
        }
        else
        {
            $clases_form = array(
                'usuario'   => form_error('usuario')? 'has-error':'',
                'password'  => form_error('password')? 'has-error':''
                );
            if($this->session->flashdata('comprar')){
            $mensaje = $this->load->view('mensaje', array(
                'mensaje' => $this->session->flashdata('comprar')
                ), TRUE);
            }
            else if($this->session->flashdata('password')){
                $mensaje = $this->load->view('mensaje', array(
                'mensaje' => $this->session->flashdata('password')
                ), TRUE);
            }
            else{
                $mensaje = $this->load->view('mensaje', 0, TRUE);
            }
            
            $formulario = $this->load->view('formulario_acceso', array(
                'clase_campo_form' => $clases_form
                ), TRUE);
            
            $this->plantilla($mensaje.$formulario);
        }
    }


    /**
     * Registro de cliente
     * @return [type] [description]
     */
    function registrar(){
        $provincias = $this->provincias_model->listar_provincias();
        
        //Reglas de validación
        //name del campo, titulo, restricciones
        $this->form_validation->set_rules('usuario', 'Usuario', 'required|min_length[3]|max_length[45]|trim|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|md5');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|max_length[45]|required');
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|max_length[45]|required');
        $this->form_validation->set_rules('dni', 'Dni', 'trim|required|callback_valid_dni');
        $this->form_validation->set_rules('direccion', 'Direccion', 'trim|max_length[45]|required');
        $this->form_validation->set_rules('cod_postal', 'Código postal', 'trim|required|numeric|exact_length[5]');
        $this->form_validation->set_rules('provincia', 'Provincia', 'required');
        //Mensajes de validación de nuestras callbacks
        //%s es el nombre del campo que tiene errores
        $this->form_validation->set_message('valid_dni', 'El Dni introducido no es válido');
        
        if($this->form_validation->run() === TRUE){
            if($this->existe_usuario($this->input->post('usuario'))){
                $formulario = $this->load->view('formulario_registro', array(
                    'provincias' => $provincias
                    ), TRUE);
                $mensaje = $this->load->view('mensaje_error', array(
                    'mensaje' => 'El usuario ya existe'
                    ), TRUE);
                $this->plantilla($mensaje.$formulario);
            }
            else if($this->existe_email($this->input->post('email'))){
                $formulario = $this->load->view('formulario_registro', array(
                    'provincias' => $provincias
                    ), TRUE);
                $mensaje = $this->load->view('mensaje_error', array(
                    'mensaje' => 'El email ya está registrado'
                    ), TRUE);
                $this->plantilla($mensaje.$formulario);
            }
            else{
                //Procedemos a crear el cliente
                $datos['usuario'] = $this->input->post('usuario');
                $datos['password'] = $this->input->post('password');
                $datos['email'] = $this->input->post('email');
                $datos['nombre'] = $this->input->post('nombre');
                $datos['apellidos'] = $this->input->post('apellidos');
                $datos['dni'] = $this->input->post('dni');
                $datos['direccion'] = $this->input->post('direccion');
                $datos['cod_postal'] = $this->input->post('cod_postal');
                $datos['provincia_id'] = $this->input->post('provincia');
                $this->clientes_model->crear_cliente($datos);
                $mensaje = $this->load->view('mensaje_exito', array(
                    'mensaje' => 'Registro realizado con éxito. Ahora ya puede acceder con su usuario y password.'
                    ), TRUE);
                $this->plantilla($mensaje);
            }
        }
        else{
            //Esto lo hacemos para dar clases Bootstrap a los 
            //campos del formulario según haya error o no
            $clases_form = array(
                'usuario'   => form_error('usuario')? 'has-error':'',
                'password'  => form_error('password')? 'has-error':'', 
                'email'     => form_error('email')? 'has-error':'',
                'nombre'    => form_error('nombre')? 'has-error':'',
                'apellidos' => form_error('apellidos')? 'has-error':'',
                'dni'       => form_error('dni')? 'has-error':'',
                'direccion' => form_error('direccion')? 'has-error':'',
                'cod_postal'=> form_error('cod_postal')? 'has-error':'',
                'provincia' => form_error('provincia')? 'has-error':''
                );
            $formulario = $this->load->view('formulario_registro', array(
                'provincias' => $provincias, 
                'clase_campo_form' => $clases_form
                ), TRUE);
            
            $this->plantilla($formulario);
        }
    }


    /**
     * Registro de cliente
     * @return [type] [description]
     */
    function editar(){

        $provincias = $this->provincias_model->listar_provincias();
        $cliente = $this->clientes_model->buscar_cliente_por_usuario($this->session->userdata('usuario'));
        
        //Reglas de validación
        //name del campo, titulo, restricciones
        $this->form_validation->set_rules('usuario', 'Usuario', 'required|min_length[3]|max_length[45]|trim|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|md5');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|max_length[45]|required');
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|max_length[45]|required');
        $this->form_validation->set_rules('dni', 'Dni', 'trim|required|callback_valid_dni');
        $this->form_validation->set_rules('direccion', 'Direccion', 'trim|max_length[45]|required');
        $this->form_validation->set_rules('cod_postal', 'Código postal', 'trim|required|numeric|exact_length[5]');
        $this->form_validation->set_rules('provincia', 'Provincia', 'required');


        if($this->form_validation->run() === TRUE){
            if($this->existe_usuario($this->input->post('usuario')) && $this->input->post('usuario') !== $this->clientes_model->buscar_cliente_por_usuario($this->input->post('usuario'))['usuario']) {
                $formulario = $this->load->view('formulario_edicion', array(
                    'provincias' => $provincias,
                    'cliente' => $cliente
                    ), TRUE);
                $mensaje = $this->load->view('mensaje_error', array(
                    'mensaje' => 'El usuario ya existe'
                    ), TRUE);
                $this->plantilla($mensaje.$formulario);
            }

            else if($this->existe_email($this->input->post('email')) && $this->input->post('email') !== $this->clientes_model->buscar_cliente_por_usuario($this->input->post('usuario'))['email']){
                $formulario = $this->load->view('formulario_edicion', array(
                    'provincias' => $provincias,
                    'cliente' => $cliente
                    ), TRUE);
                $mensaje = $this->load->view('mensaje_error', array(
                    'mensaje' => 'El email ya está registrado'
                    ), TRUE);
                $this->plantilla($mensaje.$formulario);
            }
            else{
                 //Procedemos a crear el cliente
                $datos['usuario'] = $this->input->post('usuario');
                $datos['password'] = $this->input->post('password');
                $datos['email'] = $this->input->post('email');
                $datos['nombre'] = $this->input->post('nombre');
                $datos['apellidos'] = $this->input->post('apellidos');
                $datos['dni'] = $this->input->post('dni');
                $datos['direccion'] = $this->input->post('direccion');
                $datos['cod_postal'] = $this->input->post('cod_postal');
                $datos['provincia_id'] = $this->input->post('provincia');

                $this->clientes_model->editar_cliente($this->input->post('usuario'), $datos);

                $mensaje = $this->load->view('mensaje_exito', array(
                    'mensaje' => 'Edición realizada con éxito.'
                    ), TRUE);

                $this->plantilla($mensaje);
            }
        }
        else{

            //Esto lo hacemos para dar clases Bootstrap a los 
            //campos del formulario según haya error o no
            $clases_form = array(
                'usuario'   => form_error('usuario')? 'has-error':'',
                'password'  => form_error('password')? 'has-error':'', 
                'email'     => form_error('email')? 'has-error':'',
                'nombre'    => form_error('nombre')? 'has-error':'',
                'apellidos' => form_error('apellidos')? 'has-error':'',
                'dni'       => form_error('dni')? 'has-error':'',
                'direccion' => form_error('direccion')? 'has-error':'',
                'cod_postal'=> form_error('cod_postal')? 'has-error':'',
                'provincia' => form_error('provincia')? 'has-error':''

                );

            $formulario = $this->load->view('formulario_edicion', array(
                'provincias' => $provincias, 
                'clase_campo_form' => $clases_form,
                'cliente' => $cliente
                ), TRUE);
            
            $this->plantilla($formulario);
        }
    }

    /**
     * Da de baja al usuario que esté en la sesión
     * @return [type] [description]
     */
    function dar_de_baja(){
        var_dump($this->input->post());
        if($this->input->post('si')){
            $this->clientes_model->baja_cliente($this->session->userdata('usuario'));
            $this->session->unset_userdata('usuario');
            redirect(base_url('index.php'));    
        }
        else if($this->input->post('no')){
            redirect(base_url('index.php'));
        }
        else{
            $confirmacion = $this->load->view('confirmacion_baja', array(
                'mensaje' => '¿Está seguro de que desea darse de baja?'
                ), TRUE);
            $this->plantilla($confirmacion);
        }
        
    }

    /**
     * Restaurar password del cliente
     * @return [type] [description]
     */
    function restore_pass(){

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if($this->form_validation->run() === TRUE){
            $cliente = $this->clientes_model->buscar_cliente_por_email($this->input->post('email'));

            if(!$cliente) { //email no registrado
               $mensaje = $this->load->view('mensaje_error', array(
                'mensaje' => 'El email no está registrado'
                ), TRUE);
               $formulario = $this->load->view('formulario_res_password', 0, TRUE);
               $this->plantilla($mensaje.$formulario); 
            }
            else{
                $usuario = $cliente['usuario'];
                $email = $cliente['email'];
                $password = $this->generar_password();

                if($this->mandar_mail_pass($usuario, $email, $password)){
                    //Si nos aseguramos de que llegó el email, actualizamos el password
                    $this->clientes_model->editar_cliente($usuario, array('password' => md5($password)));
                    $this->session->set_flashdata('password', 'Su password se restauró correctamente.');
                    $this->session->unset_userdata('usuario');

                }
                else{
                    $this->session->set_flashdata('password', 'Error al intentar generar su password. Vuelva a intentarlo más tarde.');

                }
                redirect(site_url('clientes/acceder'));
            }   
        }
        else{
                     //Esto lo hacemos para dar clases Bootstrap a los 
                    //campos del formulario según haya error o no
            $clases_form = array(

                'email'     => form_error('email')? 'has-error':''

                );
            $formulario = $this->load->view('formulario_res_password', array(
                'clase_campo_form' => $clases_form,
                ), TRUE);

            $this->plantilla($formulario);
        }
    }

    function listar_pedidos(){
        $cliente = $this->clientes_model->buscar_cliente_por_usuario($this->session->userdata('usuario'));
        
        $lista_pedidos = $this->pedidos_model->pedidos_usuario($cliente['id']);

        foreach ($lista_pedidos as $i=>$pedido) {
            $lista_pedidos[$i]['provincia'] = $this->provincias_model->nombre_provincia($pedido['provincia']);
        }
        
        $mensaje = '';
        if($this->session->flashdata('correo_exito')){
            $mensaje = $this->load->view('mensaje_exito', array(
                'mensaje' => $this->session->flashdata('correo_exito')
                ), TRUE); 
        }
        else if($this->session->flashdata('correo_error')){
            $mensaje = $this->load->view('mensaje_error', array(
                'mensaje' => $this->session->flashdata('correo_error')
                ), TRUE);
        }

        $vista_pedidos = $this->load->view('lista_pedidos', array(
            'pedidos' => $lista_pedidos
            ), TRUE);

        $this->plantilla($mensaje.$vista_pedidos);

    }

    /**
     * Genera un password de 10 caracteres aleatorios
     * @return [type] [description]
     */
    function generar_password(){
        $caracteres = "ABCDEFGHYJKLMOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        //Vamos a generar una clave de 10 caracteres
        $clave = '';
        for ($i=0; $i < 10; $i++) { 
            $clave.= $caracteres[rand(0, strlen($caracteres))];
        }
        return $clave;
    }

    /**
     * Mandar email al cliente con su nueva clave
     * @param  [type] $usuario [description]
     * @param  [type] $pass    [description]
     * @return [type]          [description]
     */
    public function mandar_mail_pass($user, $email, $pass){
        // Utilizando smtp
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'mail.iessansebastian.com';
        $config['smtp_user'] = 'aula4@iessansebastian.com';
        $config['smtp_pass'] = 'daw2alumno';

        $this->email->initialize($config);

        $this->email->from('jloborod@gmail.com', '2DAWShop');
        $this->email->to($email);
        $this->email->subject('Nuevo password');
        $this->email->message('Usuario: '.$user.'Nuevo password: '.$pass);
        return $this->email->send();
    }

    /**
     * Salir de la aplicación
     * @return [type] [description]
     */
    function salir(){
        if($this->input->post('si')){ //Salimos
            $this->session->unset_userdata('usuario');
            redirect(base_url('index.php'));
        }
        else if($this->input->post('no')){
            redirect(base_url('index.php'));
        }
        else{
            $confirmacion = $this->load->view('confirmar_salir', array(
                'mensaje' => '¿Está seguro de que desea cerrar la sesión?'
                ), TRUE);

            $this->plantilla($confirmacion);
        }
        
    }


    /**
     * Función para validar un dni
     * @param  [type] $dni [description]
     * @return [type]      [description]
     */
    function valid_dni($dni)
    {
        $dni = trim($dni);  
        $dni = str_replace("-","",$dni);  
        $dni = str_ireplace(" ","",$dni);

        if ( !preg_match("/^[0-9]{7,8}[a-zA-Z]{1}$/" , $dni) )
        {
            return FALSE;
        }
        else
        {
            $n = substr($dni, 0 , -1);      
            $letter = substr($dni,-1);
            $letter2 = substr ("TRWAGMYFPDXBNJZSQVHLCKE", $n%23, 1); 
            if(strtolower($letter) != strtolower($letter2))
                return FALSE;
        }
        return TRUE;
    }

    /**
     * Comprueba si el usuario existe
     * @param  [type] $usuario [description]
     * @return [type]          [description]
     */
    function existe_usuario($usuario){
        return count($this->clientes_model->buscar_clientes(array(
            'usuario' => $usuario
            )))>0;
    }

    /**
     * Comprueba si el email existe
     * @param  [type] $email [description]
     * @return [type]        [description]
     */
    function existe_email($email){
        return count($this->clientes_model->buscar_clientes(array(
            'email' => $email
            )))>0;
    }

    /**
     * Comprueba si hay algún usuario con
     * ese usuario y password
     * @param  [type] $user [description]
     * @param  [type] $pass [description]
     * @return [type]       [description]
     */
    function login_correcto($user, $pass){
        return count($this->clientes_model->buscar_clientes(array(
            'usuario' => $user,
            'password' => $pass
            )))>0;
    }

    function esta_de_baja($user){
        return $this->clientes_model->buscar_clientes(array(
            'usuario' => $user,
            'activo'  => '0'
            ));
    }
    

}

