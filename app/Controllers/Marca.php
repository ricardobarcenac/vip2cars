<?php

namespace App\Controllers;
use \App\Libraries\Complementos;
use \App\Libraries\Scripts;
use \App\Libraries\Error;
use \App\Libraries\Alertas;

class Marca extends BaseController
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
	}

	public function listarMarcas(){
		if(isset($this->items['id'])){
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
				'titulo' => 'Marcas| vip2cars',
				'breadcrumb' => 'Marcas',
				'listaMarcas' => $listaMarcas
			);
			$data = array_merge($data, $this->items);
			return view('extras/listar-marcas',$data);			
		} else {
			return view('errors/500');
		}
	}

	public function grabarMarca(){
        /*
        * ----------------------------
        * DATOS DE AJAX PRE PROCESADOS
        * ----------------------------
        */

        $msjError = TRUE;
        $marca = $this->request->getPost('nombre_marca');
        $inmediata = $this->request->getPost('inmediata');

        /*
        * ----------------------------
        * VALIDACIÓN DE REQUERIMIENTOS
        * ----------------------------
        */

        $error = '';
        $error .= $this->complementos->validaCampo($marca, 'required|trim|name|minlength[1]|maxlength[250]', 'Marca');

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
            'marca' => $marca,
			'fecha_registro' => date("Y-m-d H:i:s"),
			'eliminacion_logica' => 1
		);
		$lastId = $this->marcaModelo->insert($data, TRUE);	
	
		if($lastId !== FALSE){
			$message = sprintf($this->mensajeError->msg502, $marca);
			echo $this->alertas->alertaExito($message);
			echo $this->alertas->refrescar(1);
		}
	}

    public function obtenerInfoMarca(){
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

        /* INFORMACIÓN DE LA MARCA */
        $whereMarca = array (
            'marca.id_marca' => $marca
        );
        $datosMarca = $this->marcaModelo        
				->where($whereMarca)
				->findAll();

        if(!empty($datosMarca)){
            foreach ($datosMarca as $items) {
                $resultado[] = array(
					'marca' => (string) $items['marca']
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

	public function actualizarMarca($idMarca){
        /*
        * ----------------------------
        * DATOS DE AJAX PRE PROCESADOS
        * ----------------------------
        */

        $msjError = TRUE;
        $marca = $this->request->getPost('nombre_marca_e');

        /*
        * ----------------------------
        * VALIDACIÓN DE REQUERIMIENTOS
        * ----------------------------
        */

        $error = '';
        $error .= $this->complementos->validaCampo($marca, 'required|trim|minlength[1]|maxlength[250]', 'Marca');

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
            'marca' => $marca,
		);
		$lastId = $this->marcaModelo->update([$idMarca], $data);	
	
		if($lastId !== FALSE){
			$message = sprintf($this->mensajeError->msg503, $marca);
			echo $this->alertas->alertaExito($message);
			echo $this->alertas->refrescar(1);
		}
	}

	public function eliminarMarca($idMarca){

        /*
        * -------------
        * BASE DE DATOS
        * -------------
        */	
	
		$data = array (
			'eliminacion_logica' => 0
		);
		$lastId = $this->marcaModelo->update([$idMarca], $data);	
	
		if($lastId !== FALSE){
			$message = sprintf($this->mensajeError->msg504, "marca");
			echo $this->alertas->alertaExito($message);
			echo $this->alertas->refrescar(1);
		}
	}

	public function reactivarMarca($idMarca){

        /*
        * -------------
        * BASE DE DATOS
        * -------------
        */	
	
		$data = array (
			'eliminacion_logica' => 1
		);
		$lastId = $this->marcaModelo->update([$idMarca], $data);	
	
		if($lastId !== FALSE){
			$message = sprintf($this->mensajeError->msg503, "marca");
			echo $this->alertas->alertaExito($message);
			echo $this->alertas->refrescar(1);
		}
	}
}