<?php

namespace App\Controllers;
use \App\Libraries\Complementos;
use \App\Libraries\Scripts;
use \App\Libraries\Error;
use \App\Libraries\Alertas;

class Cliente extends BaseController
{
	public function __construct(){
		helper('form','url');
		$this->complementos = new Complementos();
		$this->scripts = new Scripts();
		$this->error = new Error();
		$this->alertas = new Alertas();	
		$this->mensajeError = $this->error->msg();
        $this->session = \Config\Services::session();
		$this->items['baseUrl'] = base_url();
        
        if(isset($this->session->get('sesionUsuario')['accesoTmpId'])){	
            $this->items['id'] = $this->session->get('sesionUsuario')['accesoTmpId'];
            $this->items['usuario'] = $this->session->get('sesionUsuario')['accesoTmpUsuario'];
            $this->items['perfil'] = $this->session->get('sesionUsuario')['accesoTmpPerfil'];
            $this->items['nombres'] = $this->session->get('sesionUsuario')['accesoTmpNombres'];
            $this->items['apellidos'] = $this->session->get('sesionUsuario')['accesoTmpApellidos'];
            $this->items['correoElectronico'] = $this->session->get('sesionUsuario')['accesoTmpCorreoElectronico'];
        }

		$this->clienteModelo = new \App\Models\ClienteModelo();
		$this->tipoDocumentoModelo = new \App\Models\TipoDocumentoModelo();
	}

	public function listarClientes(){
		if(isset($this->items['id'])){
            $whereClientes = array(
                'cliente.eliminacion_logica' => 1
            );
			$listaClientes = $this->clienteModelo
                            ->select('cliente.*, tipo_documento.tipo_documento')
                            ->where($whereClientes)
                            ->join('tipo_documento', 'tipo_documento.id_tipo_documento = cliente.tipo_documento_id')
                            ->orderBy('cliente.fecha_registro','DESC')
                            ->findAll();

            /* LISTAR TIPO DOCUMENTO */
            $whereTipoDocumento = array(
                'tipo_documento.eliminacion_logica' => 1
            );
			$listaTipoDocumento = $this->tipoDocumentoModelo
                                    ->orderBy('id_tipo_documento','DESC')
                                    ->findAll();

			$data = array (
				'titulo' => 'Clientes| vip2cars',
				'breadcrumb' => 'Clientes',
				'listaClientes' => $listaClientes,
                'listaTipoDocumento' => $listaTipoDocumento
			);
			$data = array_merge($data, $this->items);
			return view('extras/listar-clientes',$data);			
		} else {			
			return view('errors/500');	
		}
	}

    public function grabarCliente(){

        /*
        * ----------------------------
        * DATOS DE AJAX PRE PROCESADOS
        * ----------------------------
        */

        $msjError = TRUE;
        $tipoDocumento = $this->request->getPost('tipo_documento');
        $numeroDocumento = $this->request->getPost('numero_documento');
        $nombres = $this->request->getPost('nombres');
        $apellidos = $this->request->getPost('apellidos');
        $correoElectronico = $this->request->getPost('correo_electronico');
        $telefono = $this->request->getPost('telefono');

        /*
        * ----------------------------
        * VALIDACIÓN DE REQUERIMIENTOS
        * ----------------------------
        */

        $error = '';
        $error .= $this->complementos->validaCampo($tipoDocumento, 'required|trim|numeric|minlength[1]|maxlength[10]', 'Tipo de documento');
        $error .= $this->complementos->validaCampo($numeroDocumento, 'required|trim|numeric|minlength[1]|maxlength[12]', 'Número de documento');
        $error .= $this->complementos->validaCampo($nombres, 'required|trim|name|minlength[1]|maxlength[100]', 'Nombres');
        $error .= $this->complementos->validaCampo($apellidos, 'required|trim|name|minlength[1]|maxlength[100]', 'Apellidos');
        $error .= $this->complementos->validaCampo($correoElectronico, 'required|email|trim|minlength[1]|maxlength[100]', 'Correo electrónico');
        $error .= $this->complementos->validaCampo($telefono, 'required|trim|minlength[1]|maxlength[100]', 'Teléfono');

        if ($error != '') {
            $message = sprintf($this->mensajeError->msg201, $error);
            echo $this->alertas->alertaError($message);
            EXIT;
        }

        //$contrasena = $this->scripts->crearContrasena();

        $data = array (
            'tipo_documento_id' => $tipoDocumento,
            'numero_documento' => $numeroDocumento,
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'correo_electronico' => $correoElectronico,
			'telefono' => $telefono,
            'fecha_registro' => date("Y-m-d H:i:s"),
            'eliminacion_logica' => 1
        );
        $lastId = $this->clienteModelo->insert($data, TRUE);

		if($lastId !== FALSE){
			$message = sprintf($this->mensajeError->msg502, $nombres.' '.$apellidos);
			echo $this->alertas->alertaExito($message);
			echo $this->alertas->refrescar(1);
		}
    }

    public function obtenerInfoCliente(){
        /*
        * ----------------------------
        * DATOS DE AJAX PRE PROCESADOS
        * ----------------------------
        */

        $msjError = TRUE;
        $cliente = $this->request->getPost('cliente');

        /*
        * ----------------------------
        * VALIDACIÓN DE REQUERIMIENTOS
        * ----------------------------
        */

        $error = '';
        $error .= $this->complementos->validaCampo($cliente, 'required|trim|numeric|minlength[1]|maxlength[10]', 'Cliente');

        if ($error != '') {
            $message = sprintf($this->mensajeError->msg201, $error);
            echo $this->alertas->alertaError($message);
            EXIT;
        }

        /* DATOS DEL USUARIO */
        $whereCliente = array (
            'cliente.id_cliente' => $cliente,
            'cliente.eliminacion_logica' => 1
        );
        $datosCliente = $this->clienteModelo        
				->where($whereCliente)
				->findAll();
        
        if(!empty($datosCliente)){
            foreach ($datosCliente as $items) {
                $resultado[] = array(
					'id_cliente' => (string) $items['id_cliente'],
                    'tipo_documento_id' => (string) $items['tipo_documento_id'],
                    'numero_documento' => (string) $items['numero_documento'],
                    'nombres' => (string) $items['nombres'],
                    'apellidos' => (string) $items['apellidos'],
                    'correo_electronico' => (string) $items['correo_electronico'],
                    'telefono' => (string) $items['telefono'],
                );
            }
        } else {
			$resultado[] = array(
				'descripcion' => 0,
			);
		}

        /*
         * ----------------------------
         * DATOS DE AJAX PRE PROCESADOS
         * ----------------------------
         */

        echo json_encode($resultado, JSON_NUMERIC_CHECK);	
    }

    public function eliminarCliente($idCliente){
        $data = array (
            'estado' => "ELI",
            'eliminacion_logica' => 0,
            'fecha_eliminacion' => date("Y-m-d H:i:s")
        );
        $lastId = $this->clienteModelo->update([$idCliente], $data);

		if($lastId !== FALSE){
			$message = sprintf($this->mensajeError->msg504, "cliente");
			echo $this->alertas->alertaExito($message);
			echo $this->alertas->refrescar(1);
		}
    }

    public function activarCliente($idCliente){
        $data = array (
            'codigo_verificacion' => NULL,
            'estado' => "ACT",
            'fecha_eliminacion' => date("Y-m-d H:i:s")
        );
        $lastId = $this->clienteModelo->update([$idCliente], $data);

		if($lastId !== FALSE){
			$message = sprintf($this->mensajeError->msg503, "cliente");
			echo $this->alertas->alertaExito($message);
			echo $this->alertas->refrescar(1);
		}
    }

    public function actualizarCliente($idCliente){

        /*
        * ----------------------------
        * DATOS DE AJAX PRE PROCESADOS
        * ----------------------------
        */

        $msjError = TRUE;
        $tipoDocumento = $this->request->getPost('tipo_documento_e');
        $numeroDocumento = $this->request->getPost('numero_documento_e');
        $nombres = $this->request->getPost('nombres_e');
        $apellidos = $this->request->getPost('apellidos_e');
        $correoElectronico = $this->request->getPost('correo_electronico_e');
        $telefono = $this->request->getPost('telefono_e');

        /*
        * ----------------------------
        * VALIDACIÓN DE REQUERIMIENTOS
        * ----------------------------
        */

        $error = '';
        $error .= $this->complementos->validaCampo($tipoDocumento, 'required|trim|numeric|minlength[1]|maxlength[10]', 'Tipo de documento');
        $error .= $this->complementos->validaCampo($numeroDocumento, 'required|trim|numeric|minlength[1]|maxlength[12]', 'Número de documento');
        $error .= $this->complementos->validaCampo($nombres, 'required|trim|name|minlength[1]|maxlength[100]', 'Nombres');
        $error .= $this->complementos->validaCampo($apellidos, 'required|trim|name|minlength[1]|maxlength[100]', 'Apellidos');
        $error .= $this->complementos->validaCampo($correoElectronico, 'required|email|trim|minlength[1]|maxlength[100]', 'Correo electrónico');
        $error .= $this->complementos->validaCampo($telefono, 'required|trim|numeric|minlength[1]|maxlength[100]', 'Teléfono');

        if ($error != '') {
            $message = sprintf($this->mensajeError->msg201, $error);
            echo $this->alertas->alertaError($message);
            EXIT;
        }
            
        $data = array (
            'tipo_documento_id' => $tipoDocumento,
            'numero_documento' => $numeroDocumento,
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'correo_electronico' => $correoElectronico,
			'telefono' => $telefono
        );
        $lastId = $this->clienteModelo->update([$idCliente],$data);

		if($lastId !== FALSE){
			$message = sprintf($this->mensajeError->msg503, $nombres.' '.$apellidos);
			echo $this->alertas->alertaExito($message);
			echo $this->alertas->refrescar(1);
		}
    }

    public function actualizarContrasena($idCliente){

        /*
        * ----------------------------
        * DATOS DE AJAX PRE PROCESADOS
        * ----------------------------
        */

        $msjError = TRUE;
        $contrasena = $this->request->getPost('contrasena');
        $confirmarContrasena = $this->request->getPost('confirmar_contrasena');

        /*
        * ----------------------------
        * VALIDACIÓN DE REQUERIMIENTOS
        * ----------------------------
        */

        $error = '';
        $error .= $this->complementos->validaCampo($contrasena, 'required|trim|minlength[6]|maxlength[16]', 'Contraseña');
        $error .= $this->complementos->validaCampo($confirmarContrasena, 'required|trim|minlength[6]|maxlength[16]', 'Confirmar contraseña');

        if($contrasena != $confirmarContrasena){
            $error .= '<li>Las contraseñas no coinciden.</li>';
        }

        if ($error != '') {
            $message = sprintf($this->mensajeError->msg201, $error);
            echo $this->alertas->alertaError($message);
            EXIT;
        }
            
        $data = array (
            'contrasena' => sha1($contrasena),
            'cliente_id' => $this->items['id'],    
            'cliente_nombres' => $this->items['nombres'].' '.$this->items['apellidoPaterno'].' '.$this->items['apellidoMaterno'],
            'fecha_actualizacion' => date("Y-m-d H:i:s"), 
            'primer_cambio_contrasena' => 0,
        );
        $lastId = $this->clientesModelo->update([$idCliente],$data);

		if($lastId !== FALSE){
			$message = sprintf($this->mensajeError->msg503, "contrasena");
			echo $this->alertas->alertaExito($message);
            if($this->items['nivel'] == 500){
                echo $this->alertas->refrescar(1);
            } else {                
				echo $this->alertas->reDireccion($this->items['baseUrl'] . '/salir', 1);
            }
		}
    }

	public function reporteClientes(){
		/* QUERY */
        $listaClientes = $this->clienteModelo
                            ->select('cliente.*, tipo_documento.tipo_documento')
                            ->join('tipo_documento','cliente.tipo_documento_id = tipo_documento.id_tipo_documento')
                            ->orderBy('cliente.id_cliente','ASC')
                            ->findAll();

		/* CREAR REPORTE */
		$filename = 'Reporte de Clientes - "'.date("d-m-Y H:i:s") . '.csv';
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $filename);

		// Agregar el BOM para que Excel reconozca la codificación UTF-8
		echo "\xEF\xBB\xBF";  // Esta línea añade el BOM UTF-8
		
		// Abrir la salida en buffer para escribir el archivo CSV
		$output = fopen('php://output', 'w');

		// Definir las columnas manualmente
		$columnas = ['Tipo de documento','Número de documento','Nombres','Apellidos','Correo electrónico','Teléfono','Fecha de registro'];
		fputcsv($output, $columnas, ';');  // Usar ";" como delimitador

		/* BUSCAR ACTIVOS */
		$datos = [];

		foreach($listaClientes as $items){
			$linea = [
				$items['tipo_documento'],
				$items['numero_documento'],
				$items['nombres'],
				$items['apellidos'],
				$items['correo_electronico'],
				$items['telefono'],
				$items['fecha_registro']
			];

			array_push($datos, $linea);
		}

		// Escribir cada fila de datos en el archivo CSV
		foreach ($datos as $fila) {
			fputcsv($output, $fila, ";");
		}

		// Cerrar el archivo CSV
		fclose($output);
	}
}