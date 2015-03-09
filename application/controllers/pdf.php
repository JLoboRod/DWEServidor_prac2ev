<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Pdf extends My_Controller {

	function __construct(){
		parent::__construct();
	}

	function index(){
		if(!file_exists(RUTA_PDF."lista_provincias.pdf")){
			$this->generar_pdf();
		}
		$this->mail_con_adjuntos();
	}

	/**
	 * Envia un mail con un pdf adjunto con tres protocolos distintos
	 * @return [type] [description]
	 */
	private function mail_con_adjuntos(){
		//$this->load->library('email'); //Cargado en autoload

		// Probamos con diferentes configuraciones de correo
		
		// Por defecto
		echo "<h1>\n--- POR DEFECTO ---\n</h1>";
		$this->envia_correo();
		
		
		// Utilizando sendmail
		$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		
		$this->email->initialize($config);
		
		echo "<h1>\n--- CON SENDMAIL ---\n</h1>";
		$this->envia_correo();
		
		// Utilizando smtp
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'mail.iessansebastian.com';
		$config['smtp_user'] = 'aula4@iessansebastian.com';
		$config['smtp_pass'] = 'daw2alumno';
		
		$this->email->initialize($config);
		
		echo "<h1>\n--- CON SMTP y cuenta en servidor externo ---\n</h1>";
		$this->envia_correo();
	
	}


	private function envia_correo()
	{
		$this->email->from('aula4@iessansebastian.com', 'Prueba Automática desde CI');
		//$this->email->from('jloborod@gmail.com', 'Prueba Automática desde CI_ YEAH!');
		//$this->email->to('malcudia@gmail.com'); //OJO!!: Aquí una dirección de mail válida
		//$this->email->to('lcargomez@gmail.com');
		$this->email->to('jloborod@gmail.com');
		//$this->email->cc('another@another-example.com'); 
		//$this->email->bcc('them@their-example.com'); 
		if(file_exists(RUTA_PDF."lista_provincias.pdf")){
			$this->email->attach(RUTA_PDF."lista_provincias.pdf");
			$this->email->subject('Prueba de envio correo CodeIgniter');
			$this->email->message('Mensaje de prueba enviado.');	
			
			if ( $this->email->send() )
			{
				echo "<pre>\n\nENVIADO CON EXITO\n</pre>";
				$this->load->view('vista_ok', array(
				'mensaje' => 'El email se envió correctamente, compruebe su bandeja de entrada...'
				));
			}
			else 
			{
				echo "</pre>\n\n**** NO SE HA ENVIADO ****</pre>\n";
				$this->load->view('vista_error', array(
				'error' => 'OOPS, error al intentar enviar el email...'
				));
			}
			
		}
		else{
			$this->load->view('vista_error', array(
				'error' => 'OOPS, error al crear el archivo adjunto...'
				));
		}

		//echo $this->email->print_debugger();		
	}


	private function generar_pdf(){
		$this->load->model('provincias_model');
        
        $provincias= $this->provincias_model->listar_provincias();
        $this->pdf= new My_pdf();
        $this->pdf->AddPage();
        $this->pdf->AliasNbPages();
        
        $this->pdf->SetTitle("Factura");
        $this->pdf->SetLeftMargin(15);
        $this->pdf->SetRightMargin(15);
        $this->pdf->SetFillColor(200,200,200);
 
        // Se define el formato de fuente: Arial, negritas, tamaño 9
        $this->pdf->SetFont('Arial', 'B', 9);
        /*
         * TITULOS DE COLUMNAS
         *
         * $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
         */
 
        $this->pdf->Cell(15,7,'COD','TBL',0,'C','1');
        $this->pdf->Cell(38,7,'Nombre','TBR',0,'L','1');
         $this->pdf->Ln(7);
        // La variable $x se utiliza para mostrar un número consecutivo
        //$x = 1; //Esto es para numerar las filas
        foreach ($provincias as $provincia) {
            // se imprime el numero actual y despues se incrementa el valor de $x en uno
            //$this->pdf->Cell(15,5,$x++,'BL',0,'C',0); //Esto sería para el número de fila
            // Se imprimen los datos de cada alumno
            $this->pdf->Cell(15,7,$provincia['id'],'BLR',0,'C',0);
            $this->pdf->Cell(38,7,utf8_decode($provincia['nombre']),'BR',0,'C',0);
           
            //Se agrega un salto de linea
            $this->pdf->Ln(7);
        }
        /*
         * Se manda el pdf al navegador
         *
         * $this->pdf->Output(nombredelarchivo, destino);
         *
         * I = Muestra el pdf en el navegador
         * D = Envia el pdf para descarga
         *
         */
        //$this->pdf->Output("Lista de provincias.pdf", 'I');
        $this->pdf->Output(RUTA_PDF."lista_provincias.pdf", 'F');
	}


}