<?php

namespace App\Controllers;
use \App\Libraries\Complementos;
use \App\Libraries\Scripts;
use \App\Libraries\Error;
use \App\Libraries\Alertas;

class Vehiculo extends BaseController
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
        $this->marcaModelo = new \App\Models\MarcaModelo();
		$this->modeloModelo = new \App\Models\ModeloModelo();
	}

	public function listarVehiculos(){
		if(isset($this->items['id'])){
            /* LISTAR VEHICULOS */
			$listaVehiculos = $this->vehiculoModelo
                                ->select('vehiculo.*, modelo.modelo, marca.marca')
                                ->join('modelo', 'modelo.id_modelo = vehiculo.modelo_id')
                                ->join('marca', 'marca.id_marca = modelo.marca_id')
                                ->orderBy('id_vehiculo','ASC')
								->findAll();

            /* LISTAR MARCAS */
            $whereMarcas = array(
                'marca.eliminacion_logica' => 1
            );
			$listaMarcas = $this->marcaModelo
                                ->where($whereMarcas)
                                ->orderBy('id_marca','ASC')
                                ->findAll();

			$data = array (
				'session' => 'on',
				'titulo' => 'Vehiculos| vip2cars',
				'breadcrumb' => 'Vehiculos',
				'listaVehiculos' => $listaVehiculos,
                'listaMarcas' => $listaMarcas
			);
			$data = array_merge($data, $this->items);
			return view('extras/listar-vehiculos',$data);			
		} else {
			return view('errors/500');
		}
	}

	public function grabarVehiculo(){
        /*
        * ----------------------------
        * DATOS DE AJAX PRE PROCESADOS
        * ----------------------------
        */

        $msjError = TRUE;
        $modelo = $this->request->getPost('modelo_vehiculo');
        $placa = $this->request->getPost('placa');
        $anoFabricacion = $this->request->getPost('ano_fabricacion');

        /*
        * ----------------------------
        * VALIDACIÓN DE REQUERIMIENTOS
        * ----------------------------
        */

        $error = '';
        $error .= $this->complementos->validaCampo($modelo, 'required|trim|numeric|minlength[1]|maxlength[10]', 'Modelo');
        $error .= $this->complementos->validaCampo($placa, 'required|trim|minlength[1]|maxlength[250]', 'Placa');
        $error .= $this->complementos->validaCampo($anoFabricacion, 'required|trim|numeric|minlength[1]|maxlength[10]', 'Año de fabricación');

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
            'modelo_id' => $modelo,
            'placa' => $placa,
            'ano_fabricacion' => $anoFabricacion,
			'fecha_registro' => date("Y-m-d H:i:s"),
			'eliminacion_logica' => 1
		);
		$lastId = $this->vehiculoModelo->insert($data, TRUE);	
	
		if($lastId !== FALSE){
			$message = sprintf($this->mensajeError->msg502, "vehículo");
			echo $this->alertas->alertaExito($message);
			echo $this->alertas->refrescar(1);
		}
	}

    public function obtenerInfoVehiculo(){
        /*
        * ----------------------------
        * DATOS DE AJAX PRE PROCESADOS
        * ----------------------------
        */

        $msjError = TRUE;
        $vehiculo = $this->request->getPost('vehiculo');

        /*
        * ----------------------------
        * VALIDACIÓN DE REQUERIMIENTOS
        * ----------------------------
        */

        $error = '';
        $error .= $this->complementos->validaCampo($vehiculo, 'required|trim|numeric|minlength[1]|maxlength[10]', 'ID Vehiculo');

        if ($error != '') {
            $message = sprintf($this->mensajeError->msg201, $error);
            echo $this->alertas->alertaError($message);
            EXIT;
        }
        
        $whereVehiculo = array (
            'vehiculo.id_vehiculo' => $vehiculo
        );
        $datosVehiculo = $this->vehiculoModelo        
                                ->select('vehiculo.*, modelo.id_modelo, marca.id_marca')
                                ->join('modelo', 'modelo.id_modelo = vehiculo.modelo_id')
                                ->join('marca', 'marca.id_marca = modelo.marca_id')
                                ->where($whereVehiculo)
                                ->findAll();

        if(!empty($datosVehiculo)){
            foreach ($datosVehiculo as $items) {
                $resultado[] = array(
                    'marca_id' => (string) $items['id_marca'],
					'modelo_id' => (string) $items['id_modelo'],
					'placa' => (string) $items['placa'],
					'ano_fabricacion' => (string) $items['ano_fabricacion']
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

	public function actualizarVehiculo($idVehiculo){
        /*
        * ----------------------------
        * DATOS DE AJAX PRE PROCESADOS
        * ----------------------------
        */

        $msjError = TRUE;
        $modelo = $this->request->getPost('modelo_vehiculo_e');
        $placa = $this->request->getPost('placa_e');
        $anoFabricacion = $this->request->getPost('ano_fabricacion_e');

        /*
        * ----------------------------
        * VALIDACIÓN DE REQUERIMIENTOS
        * ----------------------------
        */

        $error = '';
        $error .= $this->complementos->validaCampo($modelo, 'required|trim|numeric|minlength[1]|maxlength[10]', 'Modelo');
        $error .= $this->complementos->validaCampo($placa, 'required|trim|minlength[1]|maxlength[250]', 'Placa');
        $error .= $this->complementos->validaCampo($anoFabricacion, 'required|trim|numeric|minlength[1]|maxlength[10]', 'Año de fabricación');

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
            'modelo_id' => $modelo,
            'placa' => $placa,
            'ano_fabricacion' => $anoFabricacion,
		);
		$lastId = $this->vehiculoModelo->update([$idVehiculo], $data);	
	
		if($lastId !== FALSE){
			$message = sprintf($this->mensajeError->msg503, "vehículo");
			echo $this->alertas->alertaExito($message);
			echo $this->alertas->refrescar(1);
		}
	}

	public function eliminarVehiculo($idVehiculo){

        /*
        * -------------
        * BASE DE DATOS
        * -------------
        */	
	
		$data = array (
			'eliminacion_logica' => 0
		);
		$lastId = $this->vehiculoModelo->update([$idVehiculo], $data);	
	
		if($lastId !== FALSE){
			$message = sprintf($this->mensajeError->msg504, "vehiculo");
			echo $this->alertas->alertaExito($message);
			echo $this->alertas->refrescar(1);
		}
	}

	public function reactivarVehiculo($idVehiculo){

        /*
        * -------------
        * BASE DE DATOS
        * -------------
        */	
	
		$data = array (
			'eliminacion_logica' => 1
		);
		$lastId = $this->vehiculoModelo->update([$idVehiculo], $data);	
	
		if($lastId !== FALSE){
			$message = sprintf($this->mensajeError->msg503, "vehiculo");
			echo $this->alertas->alertaExito($message);
			echo $this->alertas->refrescar(1);
		}
	}
}