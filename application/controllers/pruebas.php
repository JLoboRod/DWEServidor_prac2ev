<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Pruebas extends My_Controller {
    /**
     * Restaurar password del cliente
     * @return [type] [description]
     */
    function restore_pass(){
        $cliente = $this->clientes_model->buscar_cliente_por_usuario($this->session->userdata('usuario'));

        $password = $this->generar_password();
        var_dump($cliente['email']);
        var_dump($password);
        //$this->mandar_email($cliente['email'], $password);
        
        $config['protocol']  = 'smtp';
        $config['smtp_host'] = 'mail.iessansebastian.com';
        $config['smtp_user'] = 'aula4@iessansebastian.com';
        $config['smtp_pass'] = 'daw2alumno';

        $this->email->initialize($config);

        $this->email->from('jloborod@gmail.com', '2DAWShop');
        $this->email->to($cliente['email']);
        $this->email->subject('Nuevo password');
        $this->email->message('Nuevo password: '.$password);
        
        $this->email->send();


        /*
        if($envio_correcto){
            //Si nos aseguramos de que llegó el email, actualizamos el password
            $this->clientes_model->editar_cliente($cliente['usuario'], array('password' => md5($pass)));
            $this->session->set_flashdata('password', 'Su password se restauro correctamente.');
        }
        else{
            $this->session->set_flashdata('password', 'Error al intentar generar su password. Vuelva a intentarlo más tarde.');
        }
        */
    }

    function mandar_email($email, $pass){
        // Utilizando smtp
        $config['protocol']  = 'smtp';
        $config['smtp_host'] = 'mail.iessansebastian.com';
        $config['smtp_user'] = 'aula4@iessansebastian.com';
        $config['smtp_pass'] = 'daw2alumno';

        $this->email->initialize($config);

        $this->email->from('jloborod@gmail.com', '2DAWShop');
        $this->email->to($email);
        $this->email->subject('Nuevo password');
        $this->email->message('Nuevo password: '.$pass);
        
        $this->email->send();
        
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
            $clave.= $caracteres[rand(0, strlen($caracteres) - 1)];
        }
        return $clave;
    }

    /**
     * Mandar email al cliente con su nueva clave
     * @param  [type] $usuario [description]
     * @param  [type] $pass    [description]
     * @return [type]          [description]
     */
    public function mandar_mail_pass($user, $pass){
        $cliente = $this->clientes_model->buscar_cliente_por_usuario($user);
        var_dump($cliente['email']);
        // Utilizando smtp
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'mail.iessansebastian.com';
        $config['smtp_user'] = 'aula4@iessansebastian.com';
        $config['smtp_pass'] = 'daw2alumno';

        $this->email->initialize($config);

        $this->email->from('jloborod@gmail.com', '2DAWShop');
        $this->email->to($cliente['email']);
        $this->email->subject('Nuevo password');
        $this->email->message('Nuevo password: '.$pass);
        if($this->email->send()){
            //Si nos aseguramos de que llegó el email, actualizamos el password
            $this->clientes_model->editar_cliente($cliente['usuario'], array('password' => md5($pass)));
            $this->session->set_flashdata('password', 'Su password se restauro correctamente.');
        }
        else{
            $this->session->set_flashdata('password', 'Error al intentar generar su password. Vuelva a intentarlo más tarde.');
        }
        
    }
