<?php

namespace App\Controllers;
use \App\Libraries\Complementos;
use \App\Libraries\Scripts;
use \App\Libraries\Error;
use \App\Libraries\Alertas;

class VehiculoCliente extends BaseController
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
        
		$this->vehiculoModelo = new \App\Models\VehiculoModelo();
        $this->vehiculoClienteModelo = new \App\Models\VehiculoClienteModelo();
        $this->clienteModelo = new \App\Models\ClienteModelo();
        $this->marcaModelo = new \App\Models\MarcaModelo();
		$this->modeloModelo = new \App\Models\ModeloModelo();
	}

	public function listarVehiculoClientes(){
		if(isset($this->items['id'])){

            /* LISTAR VEHICULOS CLIENTES */
            $whereVehiculoClientes = array(
                'vehiculo_cliente.eliminacion_logica' => 1
            );
			$listaVehiculoClientes = $this->vehiculoClienteModelo
                                ->select('vehiculo_cliente.*, vehiculo.placa, marca.marca, modelo.modelo, vehiculo.ano_fabricacion, cliente.nombres, cliente.apellidos, tipo_documento.tipo_documento, cliente.numero_documento, cliente.correo_electronico, cliente.telefono')
                                ->join('vehiculo', 'vehiculo.id_vehiculo = vehiculo_cliente.vehiculo_id')   
                                ->join('cliente', 'cliente.id_cliente = vehiculo_cliente.cliente_id')                        
                                ->join('tipo_documento', 'tipo_documento.id_tipo_documento = cliente.tipo_documento_id')
                                ->join('modelo', 'modelo.id_modelo = vehiculo.modelo_id')
                                ->join('marca', 'marca.id_marca = modelo.marca_id')
                                ->where($whereVehiculoClientes)
                                ->orderBy('id_vehiculo_cliente','ASC')
                                ->findAll();

            /* LISTAR VEHICULOS */
            $whereVehiculos = array(
                'vehiculo.eliminacion_logica' => 1
            );
			$listaVehiculos = $this->vehiculoModelo
                                ->select('vehiculo.*, modelo.modelo, marca.marca')
                                ->join('modelo', 'modelo.id_modelo = vehiculo.modelo_id')
                                ->join('marca', 'marca.id_marca = modelo.marca_id')
                                ->orderBy('id_vehiculo','ASC')
								->findAll();

            /* LISTAR CLIENTES */
            $whereClientes = array(
                'cliente.eliminacion_logica' => 1
            );
			$listaClientes = $this->clienteModelo
                                ->select('cliente.*, tipo_documento.tipo_documento')
                                ->where($whereClientes)
                                ->join('tipo_documento', 'tipo_documento.id_tipo_documento = cliente.tipo_documento_id')
                                ->orderBy('id_cliente','ASC')
                                ->findAll();

			$data = array (
				'session' => 'on',
				'titulo' => 'Vehiculos Clientes| vip2cars',
				'breadcrumb' => 'Vehiculos Clientes',
                'listaVehiculoClientes' => $listaVehiculoClientes,
				'listaVehiculos' => $listaVehiculos,
                'listaClientes' => $listaClientes
			);
			$data = array_merge($data, $this->items);
			return view('extras/listar-vehiculo-clientes',$data);			
		} else {
			return view('errors/500');
		}
	}

	public function grabarVehiculoCliente(){
        /*
        * ----------------------------
        * DATOS DE AJAX PRE PROCESADOS
        * ----------------------------
        */

        $msjError = TRUE;
        $vehiculo = $this->request->getPost('vehiculo');
        $cliente = $this->request->getPost('cliente');

        /*
        * ----------------------------
        * VALIDACIÓN DE REQUERIMIENTOS
        * ----------------------------
        */

        $error = '';
        $error .= $this->complementos->validaCampo($vehiculo, 'required|trim|numeric|minlength[1]|maxlength[10]', 'Vehiculo');
        $error .= $this->complementos->validaCampo($cliente, 'required|trim|numeric|minlength[1]|maxlength[10]', 'Cliente');

        if ($error != '') {
            $message = sprintf($this->mensajeError->msg201, $error);
            echo $this->alertas->alertaError($message);
            EXIT;
        }

        /*
        * -------------
        * BASE DE DATOS
        * -------------
        */
	
		$data = array (
            'vehiculo_id' => $vehiculo,
            'cliente_id' => $cliente,
			'fecha_registro' => date("Y-m-d H:i:s"),
			'eliminacion_logica' => 1
		);
		$lastId = $this->vehiculoClienteModelo->insert($data, TRUE);	
	
		if($lastId !== FALSE){
			$message = sprintf($this->mensajeError->msg502, "vehículo cliente");
			echo $this->alertas->alertaExito($message);
			echo $this->alertas->refrescar(1);
		}
	}

    public function obtenerInfoVehiculoCliente(){
        /*
        * ----------------------------
        * DATOS DE AJAX PRE PROCESADOS
        * ----------------------------
        */

        $msjError = TRUE;
        $vehiculoCliente = $this->request->getPost('vehiculoCliente');

        /*
        * ----------------------------
        * VALIDACIÓN DE REQUERIMIENTOS
        * ----------------------------
        */

        $error = '';
        $error .= $this->complementos->validaCampo($vehiculoCliente, 'required|trim|numeric|minlength[1]|maxlength[10]', 'ID Vehiculo Cliente');

        if ($error != '') {
            $message = sprintf($this->mensajeError->msg201, $error);
            echo $this->alertas->alertaError($message);
            EXIT;
        }
        
        $whereVehiculoCliente = array (
            'vehiculo_cliente.id_vehiculo_cliente' => $vehiculoCliente
        );
        $datosVehiculo = $this->vehiculoClienteModelo        
                                ->where($whereVehiculoCliente)
                                ->findAll();

        if(!empty($datosVehiculo)){
            foreach ($datosVehiculo as $items) {
                $resultado[] = array(
                    'vehiculo_id' => (string) $items['vehiculo_id'],
                    'cliente_id' => (string) $items['cliente_id'],
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

	public function actualizarVehiculoCliente($idVehiculoCliente){
        /*
        * ----------------------------
        * DATOS DE AJAX PRE PROCESADOS
        * ----------------------------
        */

        $msjError = TRUE;
        $vehiculo = $this->request->getPost('vehiculo_e');
        $cliente = $this->request->getPost('cliente_e');

        /*
        * ----------------------------
        * VALIDACIÓN DE REQUERIMIENTOS
        * ----------------------------
        */

        $error = '';
        $error .= $this->complementos->validaCampo($vehiculo, 'required|trim|numeric|minlength[1]|maxlength[10]', 'Vehiculo');
        $error .= $this->complementos->validaCampo($cliente, 'required|trim|numeric|minlength[1]|maxlength[10]', 'Cliente');

        if ($error != '') {
            $message = sprintf($this->mensajeError->msg201, $error);
            echo $this->alertas->alertaError($message);
            EXIT;
        }

        /*
        * -------------
        * BASE DE DATOS
        * -------------
        */
	
		$data = array (
            'vehiculo_id' => $vehiculo,
            'cliente_id' => $cliente,
		);
		$lastId = $this->vehiculoClienteModelo->update([$idVehiculoCliente], $data);	
	
		if($lastId !== FALSE){
			$message = sprintf($this->mensajeError->msg503, "vehículo cliente");
			echo $this->alertas->alertaExito($message);
			echo $this->alertas->refrescar(1);
		}
	}

	public function eliminarVehiculoCliente($idVehiculoCliente){

        /*
        * -------------
        * BASE DE DATOS
        * -------------
        */	
	
		$data = array (
			'eliminacion_logica' => 0
		);
		$lastId = $this->vehiculoClienteModelo->update([$idVehiculoCliente], $data);	
	
		if($lastId !== FALSE){
			$message = sprintf($this->mensajeError->msg504, "vehiculo cliente");
			echo $this->alertas->alertaExito($message);
			echo $this->alertas->refrescar(1);
		}
	}

	public function reactivarVehiculoCliente($idVehiculoCliente){

        /*
        * -------------
        * BASE DE DATOS
        * -------------
        */	
	
		$data = array (
			'eliminacion_logica' => 1
		);
		$lastId = $this->vehiculoClienteModelo->update([$idVehiculoCliente], $data);	
	
		if($lastId !== FALSE){
			$message = sprintf($this->mensajeError->msg503, "vehiculo cliente");
			echo $this->alertas->alertaExito($message);
			echo $this->alertas->refrescar(1);
		}
	}
}