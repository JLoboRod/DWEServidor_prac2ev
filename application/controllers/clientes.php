<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Clientes extends My_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('clientes_model');
        $this->load->model('provincias_model');
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
                //Añade usuario a la session
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
            $mensaje = $this->load->view('mensaje', array(
                'mensaje' => $this->session->flashdata('comprar')
                ), TRUE);

            
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
     * Salir de la aplicación
     * @return [type] [description]
     */
    function salir(){
        $this->session->unset_userdata('usuario');
        redirect(base_url('index.php'));
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

