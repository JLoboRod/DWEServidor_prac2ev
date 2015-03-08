<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Clientes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('clientes_model');
        $this->load->model('provincias_model');
        $this->load->helper('filtrado');
    }
    
    function index(){

    }
    
    function registrar(){

        $provincias = $this->provincias_model->listar_provincias();
        
        //Validamos
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
                $formulario = $this->load->view('formulario_registro', Array(
                    'provincias' => $provincias
                    ), TRUE);
                $mensaje = $this->load->view('mensaje_error', array(
                    'mensaje' => 'El usuario ya existe'
                    ), TRUE);
                $this->plantilla($mensaje.$formulario);
            }

            else if($this->existe_email($this->input->post('email'))){
                $formulario = $this->load->view('formulario_registro', Array(
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
                    'mensaje' => 'Registro realizado'
                    ));
            }
        }
        else{

            $formulario = $this->load->view('formulario_registro', array(
                'provincias' => $provincias
                ), TRUE);
            
            $this->plantilla($formulario);
        }

    }

    /**
     * Carga la plantilla html (encabezado, menu, cuerpo y pie).
     * @param unknown $cuerpo
     */
    protected function plantilla($cuerpo)
    {
        if(isset($this->session->userdata['valido']))
        {
            $sesion = $this->session->userdata['valido'];
            
            //Carga del encabezado
            $encabezado = $this->load->view('encabezado', $sesion, TRUE);
        }
        else 
        {
            //Carga del encabezado
            $encabezado = $this->load->view('encabezado', '', TRUE);
        }
        $pie = $this->load->view('pie', 0, TRUE);
        
        //Creo una plantilla con los apartados a mostrar
        $this->load->view('plantilla', array(
            'encabezado' => $encabezado,
            'cuerpo' => $cuerpo,
            'pie' => $pie
            ));
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

    function existe_usuario($usuario){
        return count($this->clientes_model->buscar_clientes(array(
            'usuario' => $usuario
            )))>0;
    }

    function existe_email($email){
        return count($this->clientes_model->buscar_clientes(array(
            'email' => $email
            )))>0;
    }
    

}

