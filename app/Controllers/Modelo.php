<?php

namespace App\Controllers;
use \App\Libraries\Complementos;
use \App\Libraries\Scripts;
use \App\Libraries\Error;
use \App\Libraries\Alertas;

class Modelo extends BaseController
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
        
		$this->marcaModelo = new \App\Models\MarcaModelo();
		$this->modeloModelo = new \App\Models\ModeloModelo();
	}

	public function listarModelos(){
		if(isset($this->items['id'])){
            /* LISTAR MODELOS */
			$listaModelos = $this->modeloModelo
                                ->select('modelo.*, marca.marca')
                                ->join('marca', 'marca.id_marca = modelo.marca_id')
                                ->orderBy('id_modelo','ASC')
								->findAll();

            /* LISTAR MARCAS */
			$listaMarcas = $this->marcaModelo
                            ->orderBy('id_marca','ASC')
                            ->findAll();

			$data = array (
				'session' => 'on',
				'titulo' => 'Modelos| vip2cars',
				'breadcrumb' => 'Modelos',
				'listaModelos' => $listaModelos,
                'listaMarcas' => $listaMarcas
			);
			$data = array_merge($data, $this->items);
			return view('extras/listar-modelos',$data);			
		} else {
			return view('errors/500');
		}
	}

	public function grabarModelo(){
        /*
        * ----------------------------
        * DATOS DE AJAX PRE PROCESADOS
        * ----------------------------
        */

        $msjError = TRUE;
        $marca = $this->request->getPost('marca');
        $modelo = $this->request->getPost('nombre_modelo');

        /*
        * ----------------------------
        * VALIDACIÓN DE REQUERIMIENTOS
        * ----------------------------
        */

        $error = '';
        $error .= $this->complementos->validaCampo($marca, 'required|trim|numeric|minlength[1]|maxlength[10]', 'Marca');
        $error .= $this->complementos->validaCampo($modelo, 'required|trim|alphanumeric|minlength[1]|maxlength[250]', 'Modelo');

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
            'marca_id' => $marca,
            'modelo' => $modelo,
			'fecha_registro' => date("Y-m-d H:i:s"),
			'eliminacion_logica' => 1
		);
		$lastId = $this->modeloModelo->insert($data, TRUE);	
	
		if($lastId !== FALSE){
			$message = sprintf($this->mensajeError->msg502, $modelo);
			echo $this->alertas->alertaExito($message);
			echo $this->alertas->refrescar(1);
		}
	}

    public function obtenerInfoModelo(){
        /*
        * ----------------------------
        * DATOS DE AJAX PRE PROCESADOS
        * ----------------------------
        */

        $msjError = TRUE;
        $modelo = $this->request->getPost('modelo');

        /*
        * ----------------------------
        * VALIDACIÓN DE REQUERIMIENTOS
        * ----------------------------
        */

        $error = '';
        $error .= $this->complementos->validaCampo($modelo, 'required|trim|numeric|minlength[1]|maxlength[10]', 'ID Modelo');
                
        if ($error != '') {
            $message = sprintf($this->mensajeError->msg201, $error);
            echo $this->alertas->alertaError($message);
            EXIT;
        }

        
        $whereModelo = array (
            'modelo.id_modelo' => $modelo
        );
        $datosModelo = $this->modeloModelo        
				->where($whereModelo)
				->findAll();

        if(!empty($datosModelo)){
            foreach ($datosModelo as $items) {
                $resultado[] = array(
                    'marca_id' => (string) $items['marca_id'],
					'modelo' => (string) $items['modelo']
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

	public function actualizarModelo($idModelo){
        /*
        * ----------------------------
        * DATOS DE AJAX PRE PROCESADOS
        * ----------------------------
        */

        $msjError = TRUE;
        $marca = $this->request->getPost('marca_e');
        $modelo = $this->request->getPost('nombre_modelo_e');

        /*
        * ----------------------------
        * VALIDACIÓN DE REQUERIMIENTOS
        * ----------------------------
        */

        $error = '';
        $error .= $this->complementos->validaCampo($marca, 'required|trim|numeric|minlength[1]|maxlength[10]', 'Marca');
        $error .= $this->complementos->validaCampo($modelo, 'required|trim|alphanumeric|minlength[1]|maxlength[250]', 'Modelo');

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
            'marca_id' => $marca,
            'modelo' => $modelo,
		);
		$lastId = $this->modeloModelo->update([$idModelo], $data);	
	
		if($lastId !== FALSE){
			$message = sprintf($this->mensajeError->msg503, $modelo);
			echo $this->alertas->alertaExito($message);
			echo $this->alertas->refrescar(1);
		}
	}

	public function eliminarModelo($idModelo){

        /*
        * -------------
        * BASE DE DATOS
        * -------------
        */	
	
		$data = array (
			'eliminacion_logica' => 0
		);
		$lastId = $this->modeloModelo->update([$idModelo], $data);	
	
		if($lastId !== FALSE){
			$message = sprintf($this->mensajeError->msg504, "modelo");
			echo $this->alertas->alertaExito($message);
			echo $this->alertas->refrescar(1);
		}
	}

	public function reactivarModelo($idModelo){

        /*
        * -------------
        * BASE DE DATOS
        * -------------
        */	
	
		$data = array (
			'eliminacion_logica' => 1
		);
		$lastId = $this->modeloModelo->update([$idModelo], $data);	
	
		if($lastId !== FALSE){
			$message = sprintf($this->mensajeError->msg503, "modelo");
			echo $this->alertas->alertaExito($message);
			echo $this->alertas->refrescar(1);
		}
	}

    public function obtenerModelos(){
        /*
        * ----------------------------
        * DATOS DE AJAX PRE PROCESADOS
        * ----------------------------
        */

        $msjError = TRUE;
        $marca = $this->request->getPost('marca');

        /*
        * ----------------------------
        * VALIDACIÓN DE REQUERIMIENTOS
        * ----------------------------
        */

        $error = '';
        $error .= $this->complementos->validaCampo($marca, 'required|trim|numeric|minlength[1]|maxlength[10]', 'ID Marca');

        if ($error != '') {
            $message = sprintf($this->mensajeError->msg201, $error);
            echo $this->alertas->alertaError($message);
            EXIT;
        }

        /* LISTA DE MODELOS */
        $whereModelo = array (
            'modelo.marca_id' => $marca
        );
        $listaModelos = $this->modeloModelo        
				->where($whereModelo)
				->findAll();

        if(!empty($listaModelos)){
            foreach ($listaModelos as $items) {
                $resultado[] = array(
                    'id_modelo' => (string) $items['id_modelo'],
					'modelo' => (string) $items['modelo']
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
}