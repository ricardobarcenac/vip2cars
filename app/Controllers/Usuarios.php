<?php

namespace App\Controllers;
use \App\Libraries\Complementos;
use \App\Libraries\Scripts;
use \App\Libraries\Error;
use \App\Libraries\Alertas;

class Usuarios extends BaseController
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

		$this->usuarioModelo = new \App\Models\UsuarioModelo();
		$this->perfilModelo = new \App\Models\PerfilModelo();
	}

	public function listarUsuarios(){
		if(isset($this->items['id'])){
            $whereUsuarios = array(
                'usuario.eliminacion_logica' => 1
            );
			$listaUsuarios = $this->usuarioModelo
                ->distinct()
                ->select('
                    usuario.id_usuario,
                    usuario.fecha_registro,
                    usuario.nombres,
                    usuario.apellidos,
                    usuario.correo_electronico,
                    usuario.telefono,
                    usuario.token,
                    usuario.eliminacion_logica
                ')
				->where($whereUsuarios)
				->orderBy('usuario.fecha_registro','DESC')
				->findAll();

            /* LISTAR PERFILES */
			$listaPerfiles = $this->perfilModelo
				->whereIn('id_perfil',[402,500])
				->orderBy('id_perfil','DESC')
				->findAll();

			$data = array (
				'titulo' => 'Usuarios| vip2cars',
				'breadcrumb' => 'Usuarios',
				'listaUsuarios' => $listaUsuarios,
                'listaPerfiles' => $listaPerfiles
			);
			$data = array_merge($data, $this->items);
			return view('usuarios/listar',$data);			
		} else {			
			return view('errors/500');	
		}
	}

    public function grabarUsuario(){

        /*
        * ----------------------------
        * DATOS DE AJAX PRE PROCESADOS
        * ----------------------------
        */

        $msjError = TRUE;
        $perfil = $this->request->getPost('perfil');
        $nombres = $this->request->getPost('nombres');
        $apellidos = $this->request->getPost('apellidos');
        $correoElectronico = $this->request->getPost('correo_electronico');
        $contrasena = $this->request->getPost('contrasena');
        $telefono = $this->request->getPost('telefono');

        /*
        * ----------------------------
        * VALIDACIÓN DE REQUERIMIENTOS
        * ----------------------------
        */

        $error = '';
        $error .= $this->complementos->validaCampo($perfil, 'required|trim|numeric|minlength[1]|maxlength[10]', 'Perfil');
        $error .= $this->complementos->validaCampo($nombres, 'required|trim|name|minlength[1]|maxlength[100]', 'Nombres');
        $error .= $this->complementos->validaCampo($apellidos, 'required|trim|name|minlength[1]|maxlength[100]', 'Apellidos');
        $error .= $this->complementos->validaCampo($correoElectronico, 'required|email|trim|minlength[1]|maxlength[100]', 'Correo electrónico');
        $error .= $this->complementos->validaCampo($contrasena, 'required|trim|minlength[1]|maxlength[100]', 'Contraseña');
        $error .= $this->complementos->validaCampo($telefono, 'required|trim|minlength[1]|maxlength[100]', 'Teléfono');

        if ($error != '') {
            $message = sprintf($this->mensajeError->msg201, $error);
            echo $this->alertas->alertaError($message);
            EXIT;
        }

        //$contrasena = $this->scripts->crearContrasena();

        $data = array (
            'perfil_id' => $perfil,
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'correo_electronico' => $correoElectronico,
            'usuario' => $correoElectronico,
			'telefono' => $telefono,
            'contrasena' => password_hash($contrasena, PASSWORD_DEFAULT),
            'origen_registro' => "BACKOFFICE",
            'fecha_registro' => date("Y-m-d H:i:s"),
            'eliminacion_logica' => 1
        );
        $lastId = $this->usuarioModelo->insert($data, TRUE);

		if($lastId !== FALSE){
			$message = sprintf($this->mensajeError->msg502, $nombres.' '.$apellidos);
			echo $this->alertas->alertaExito($message);
			echo $this->alertas->refrescar(1);
		}
    }

    public function obtenerInfoUsuario(){
        /*
        * ----------------------------
        * DATOS DE AJAX PRE PROCESADOS
        * ----------------------------
        */

        $msjError = TRUE;
        $usuario = $this->request->getPost('usuario');

        /*
        * ----------------------------
        * VALIDACIÓN DE REQUERIMIENTOS
        * ----------------------------
        */

        $error = '';
        $error .= $this->complementos->validaCampo($usuario, 'required|trim|numeric|minlength[1]|maxlength[10]', 'Usuario');

        if ($error != '') {
            $message = sprintf($this->mensajeError->msg201, $error);
            echo $this->alertas->alertaError($message);
            EXIT;
        }

        /* DATOS DEL USUARIO */
        $whereUsuario = array (
            'usuario.id_usuario' => $usuario,
            'usuario.eliminacion_logica' => 1
        );
        $datosUsuario = $this->usuarioModelo        
				->where($whereUsuario)
				->findAll();
        
        if(!empty($datosUsuario)){
            foreach ($datosUsuario as $items) {
                $resultado[] = array(
					'id_usuario' => (string) $items['id_usuario'],
                    'perfil_id' => (string) $items['perfil_id'],
         	        'nombres' => (string) $items['nombres'],
         	        'apellidos' => (string) $items['apellidos'],
         	        'correo_electronico' => (string) $items['correo_electronico'],
         	        'telefono' => (string) $items['telefono']
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

    public function eliminarUsuario($idUsuario){
        $data = array (
            'eliminacion_logica' => 0,
            'fecha_eliminacion' => date("Y-m-d H:i:s")
        );
        $lastId = $this->usuarioModelo->update([$idUsuario], $data);

		if($lastId !== FALSE){
			$message = sprintf($this->mensajeError->msg504, "usuario");
			echo $this->alertas->alertaExito($message);
			echo $this->alertas->refrescar(1);
		}
    }

    public function actualizarUsuario($idUsuario){

        /*
        * ----------------------------
        * DATOS DE AJAX PRE PROCESADOS
        * ----------------------------
        */

        $msjError = TRUE;
        $perfil = $this->request->getPost('perfil_e');
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
        $error .= $this->complementos->validaCampo($perfil, 'required|trim|numeric|minlength[1]|maxlength[10]', 'Perfil');
        $error .= $this->complementos->validaCampo($nombres, 'required|trim|alphanumeric|minlength[1]|maxlength[100]', 'Nombres');
        $error .= $this->complementos->validaCampo($apellidos, 'required|trim|alphanumeric|minlength[1]|maxlength[100]', 'Apellidos');
        $error .= $this->complementos->validaCampo($correoElectronico, 'required|email|trim|minlength[1]|maxlength[100]', 'Correo electrónico');
        $error .= $this->complementos->validaCampo($telefono, 'required|trim|numeric|minlength[1]|maxlength[100]', 'Teléfono');

        if ($error != '') {
            $message = sprintf($this->mensajeError->msg201, $error);
            echo $this->alertas->alertaError($message);
            EXIT;
        }

        $datosCorreo = explode("@",$correoElectronico);
        $usuario = $datosCorreo[0];
        $contrasena = $this->scripts->crearContrasena();
            
        $data = array (
            'perfil_id' => $perfil,
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'correo_electronico' => $correoElectronico,
            'usuario' => $correoElectronico,
			'telefono' => $telefono
        );
        $lastId = $this->usuarioModelo->update([$idUsuario],$data);

		if($lastId !== FALSE){
			$message = sprintf($this->mensajeError->msg503, $nombres.' '.$apellidos);
			echo $this->alertas->alertaExito($message);
			echo $this->alertas->refrescar(1);
		}
    }

	public function reporteUsuarios(){
		/* QUERY */
        $listaUsuarios = $this->usuarioModelo
                            ->select('
                                usuario.id_usuario,
                                usuario.nombres,
                                usuario.apellidos,
                                usuario.telefono,
                                usuario.correo_electronico,
                                perfil.descripcion as perfil,
                                usuario.fecha_registro
                            ')
                            ->join('perfil','usuario.perfil_id = perfil.id_perfil')
                            ->orderBy('usuario.id_usuario','ASC')
                            ->findAll();

		/* CREAR REPORTE */
		$filename = 'Reporte de Usuarios - "'.date("d-m-Y H:i:s") . '.csv';
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $filename);

		// Agregar el BOM para que Excel reconozca la codificación UTF-8
		echo "\xEF\xBB\xBF";  // Esta línea añade el BOM UTF-8
		
		// Abrir la salida en buffer para escribir el archivo CSV
		$output = fopen('php://output', 'w');

		// Definir las columnas manualmente
		$columnas = ['Id','Nombres','Apellidos','Correo electrónico','Teléfono','Perfil','Fecha de registro'];
		fputcsv($output, $columnas, ';');  // Usar ";" como delimitador

		/* BUSCAR ACTIVOS */
		$datos = [];

		foreach($listaUsuarios as $items){
			$linea = [
				$items['id_usuario'],
				$items['nombres'],
				$items['apellidos'],
				$items['correo_electronico'],
				$items['telefono'],
				$items['perfil'],
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