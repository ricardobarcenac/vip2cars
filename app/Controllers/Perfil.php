<?php

namespace App\Controllers;
use \App\Libraries\Complementos;
use \App\Libraries\Scripts;
use \App\Libraries\Error;
use \App\Libraries\Alertas;

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class Perfil extends BaseController
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
		$this->items['id'] = $this->session->get('sesionUsuario')['accesoTmpId'];
		$this->items['usuario'] = $this->session->get('sesionUsuario')['accesoTmpUsuario'];
		$this->items['perfil'] = $this->session->get('sesionUsuario')['accesoTmpPerfil'];
		$this->items['nombres'] = $this->session->get('sesionUsuario')['accesoTmpNombres'];
		$this->items['apellidos'] = $this->session->get('sesionUsuario')['accesoTmpApellidos'];
        $this->items['correoElectronico'] = $this->session->get('sesionUsuario')['accesoTmpCorreoElectronico'];

		$this->perfilModelo = new \App\Models\PerfilModelo();
	}

	public function listarPerfiles(){
		if(isset($this->items['id'])){
			/* BUSCAR PERFILES */
			$wherePerfil = array(
				//'perfil.eliminacion_logica' => 1
			);

			$listaPerfiles = $this->perfilModelo
				->where($wherePerfil)
				->findAll();

			$data = array (
				'session' => 'on',
				'titulo' => 'Perfiles (Roles)| vip2cars',
				'breadcrumb' => 'Perfiles',
				'listaPerfiles' => $listaPerfiles,
			);
			$data = array_merge($data, $this->items);
			return view('extras/listar-perfiles',$data);			
		} else {
			return view('errors/500');
		}
	}

	public function obtenerDatosPerfil(){
        /*
        * ----------------------------
        * DATOS DE AJAX PRE PROCESADOS
        * ----------------------------
        */

        $msjError = TRUE;
        $perfil = $this->request->getPost('perfil');

        /*
        * ----------------------------
        * VALIDACIÓN DE REQUERIMIENTOS
        * ----------------------------
        */

        $error = '';
        $error .= $this->complementos->validaCampo($perfil, 'required|trim|numeric|minlength[1]|maxlength[10]', 'Perfil');
                
        if ($error != '') {
            $message = sprintf($this->mensajeError->msg201, $error);
            echo $this->alertas->alertaError($message);
            EXIT;
        }

        $wherePerfil = array (
            'perfil.id_perfil' => $perfil,
            'perfil.eliminacion_logica' => 1
        );
        $datosPerfil = $this->perfilModelo
				->where($wherePerfil)
				->findAll();

        if(!empty($datosPerfil)){
            foreach ($datosPerfil as $items) {
                $resultado[] = array(
					'id_perfil' => (string) $items['id_perfil'],
         	        'nombre' => (string) $items['nombre']
                );
            }
        } else {
			$resultado = array(
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

	public function actualizarPerfil($iPerfil){

        /*
        * ----------------------------
        * DATOS DE AJAX PRE PROCESADOS
        * ----------------------------
        */

        $msjError = TRUE;
        $nombrePerfil = $this->request->getPost('nombre_perfil_e');

        /*
        * ----------------------------
        * VALIDACIÓN DE REQUERIMIENTOS
        * ----------------------------
        */

        $error = '';
        $error .= $this->complementos->validaCampo($nombrePerfil, 'required|trim|minlength[1]|maxlength[150]', 'Perfil');

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
            'nombre' => $nombrePerfil,
		);
		$lastId = $this->perfilModelo->update([$iPerfil],$data);

        if($lastId !== FALSE){
            $message = sprintf($this->mensajeError->msg503, $nombrePerfil);
            echo $this->alertas->alertaExito($message);
			echo $this->alertas->refrescar(1);
        }		
	}

	public function eliminarPerfil($idPerfil){ 

        /*
        * -------------
        * BASE DE DATOS
        * -------------
        */            
		
		$data = array (
            'eliminacion_logica' => 0
		);
		$lastId = $this->perfilModelo->update([$idPerfil],$data);

        if($lastId !== FALSE){
            $message = sprintf($this->mensajeError->msg504, "perfil");
            echo $this->alertas->alertaExito($message);
			echo $this->alertas->refrescar(1);
        }
    }

	public function reactivarPerfil($idPerfil){ 

        /*
        * -------------
        * BASE DE DATOS
        * -------------
        */            
		
		$data = array (
            'eliminacion_logica' => 1
		);
		$lastId = $this->perfilModelo->update([$idPerfil],$data);

        if($lastId !== FALSE){
            $message = sprintf($this->mensajeError->msg503, "perfil");
            echo $this->alertas->alertaExito($message);
			echo $this->alertas->refrescar(1);
        }
    }
}