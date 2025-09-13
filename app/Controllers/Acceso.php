<?php

namespace App\Controllers;
use \App\Libraries\Complementos;
use \App\Libraries\Scripts;
use \App\Libraries\Error;
use \App\Libraries\Alertas;

class Acceso extends BaseController
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

		$this->usuarioModelo = new \App\Models\UsuarioModelo();
        $this->logInicioSesionModelo = new \App\Models\LogInicioSesionModelo();
	}

	public function login(){
		/* VERIFICAR ACCESO */
		if(isset($this->session->get('sesionUsuario')['accesoTmpId'])){
            echo $this->alertas->reDireccion($this->items['baseUrl'] . '/listar-vehiculos-clientes', 1);
		} else {
            $data = array (
                'titulo' => 'Iniciar sesión| vip2cars',
            );            
            $data = array_merge($data, $this->items);
            return view('dashboard/iniciar-sesion',$data);
        }
	}

    public function crearCuenta(){
        $data = array (
            'titulo' => 'Crear cuenta| vip2cars',
        );
        $data = array_merge($data, $this->items);
        return view('dashboard/crear-cuenta',$data);
    }
	
	public function entrar(){
        /*
        * ----------------------------
        * DATOS DE AJAX PRE PROCESADOS
        * ----------------------------
        */

        $msjError = TRUE;
        $usuario = $this->request->getPost('usuario');
        $contrasena = $this->request->getPost('contrasena');

        /*
        * ----------------------------
        * VALIDACIÓN DE REQUERIMIENTOS
        * ----------------------------
        */

        $error = '';
        $error .= $this->complementos->validaCampo($usuario, 'required|trim|minlength[5]|maxlength[100]', 'Usuario');
        $error .= $this->complementos->validaCampo($contrasena, 'required|trim|minlength[5]|maxlength[50]', 'Contraseña');

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

		//$claveEncriptada = password_hash($contrasena, PASSWORD_DEFAULT);

		/* VALIDAR SI EL USUARIO EXISTE */
		$whereUsuario = array('usuario' => $usuario, 'eliminacion_logica' => 1);		
		$datosUsuario = $this->usuarioModelo
                            ->where($whereUsuario)
                            ->findAll();
		
		if(empty($datosUsuario)){
			$message = sprintf($this->mensajeError->msg1, 'Usuario');
			echo $this->alertas->alertaError($message);
			EXIT;
		}

		/* VALIDAR SI LA CONTRASEÑA INGRESADA ES IGUAL A LA DEL USUARIO */		
		if (!password_verify($contrasena, $datosUsuario[0]['contrasena'])){
			$message = sprintf($this->mensajeError->msg3, 'Usuario o Clave');
			echo $this->alertas->alertaError($message);
			EXIT;
		}

        /* VALIDACIÓN FINAL DE ACCESO */
		$whereAcceso = array('usuario.usuario' => $usuario, 'usuario.contrasena' => $datosUsuario[0]['contrasena']);		
        $accesoUsuario = $this->usuarioModelo
                            ->where($whereAcceso)
                            ->findAll();
                            
        if(!empty($accesoUsuario)){
            $datos = array('sesionUsuario' =>
                array(
                    'session' => 'on',
                    'accesoTmpId' => $accesoUsuario[0]['id_usuario'],
                    'accesoTmpUsuario' => $accesoUsuario[0]['usuario'],
                    'accesoTmpPerfil' => $accesoUsuario[0]['perfil_id'],
                    'accesoTmpNombres' => $accesoUsuario[0]['nombres'],
                    'accesoTmpApellidos' => $accesoUsuario[0]['apellidos'],
                    'accesoTmpCorreoElectronico' => $accesoUsuario[0]['correo_electronico']
                )
            );  
            $this->session->set($datos);
            $message = sprintf($this->mensajeError->msg501, $accesoUsuario[0]['usuario']);
            echo $this->alertas->alertaExito($message);

            /* LOG INICIO DE SESIÓN */
            $dataLog = array (
                'ip' => $this->request->getIPAddress(),
                'usuario_id' => $accesoUsuario[0]['id_usuario'],
                'usuario' => $accesoUsuario[0]['usuario'],
                'contrasena' => $accesoUsuario[0]['contrasena'],
                'agente' => $this->request->getUserAgent(),
                'data' => json_encode($datos),
                'estado' => "ÉXITO",
                'mensaje' => $message,
                'origen' => "BACKOFFICE",
                'fecha_registro' => date("Y-m-d H:i:s"),
                'eliminacion_logica' => 1
            );
            $this->logInicioSesionModelo->insert($dataLog, TRUE);

            /* ACCESO SEGÚN PERFIL */
			switch($accesoUsuario[0]['perfil_id']){	
				case 401: //usuario
                    echo $this->alertas->reDireccion($this->items['baseUrl'] . '/listar-vehiculos-clientes', 1);
                    break;
                case 500: //administrador              
                    echo $this->alertas->reDireccion($this->items['baseUrl'] . '/listar-vehiculos-clientes', 1);
					break;
			}            
            EXIT;
        }
	    
	}

	public function olvidoContrasena(){
        $data = array (
            'titulo' => 'Olvidé mi contraseña | Verisure',
        );
        $data = array_merge($data, $this->items);
		return view('dashboard/olvido-contrasena',$data);
	}

    public function solicitarRecuperacion(){

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
        $error .= $this->complementos->validaCampo($usuario, 'required|trim|email|minlength[5]|maxlength[100]', 'Usuario');

        if ($error != '') {
            $message = sprintf($this->mensajeError->msg201, $error);
            echo $this->alertas->alertaError($message);
            EXIT;
        }     

		/* VALIDAR SI EL USUARIO EXISTE */
		$whereUsuario = array('usuario' => $usuario, 'eliminacion_logica' => 1);		
		$datosUsuario = $this->usuarioModelo->where($whereUsuario)->findAll();

		if(empty($datosUsuario)){
			$message = sprintf($this->mensajeError->msg1, 'Usuario');
			echo $this->alertas->alertaError($message);
			EXIT;
		} else {
            /* GENERA TOKEN DE ACCESO */
            $token = $this->scripts->crearCodigo(6);

            $tokenCifrado = md5($token);
            $fechaCaducidadToken = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")."+ 1 days"));
            
            $datosRecuperacion = array (
                'token' => $tokenCifrado,
                'fecha_solicitud_recuperacion' => date("Y-m-d H:i:s"),
                'fecha_caducidad_token' => $fechaCaducidadToken
            );
            $lastId = $this->usuarioModelo->update([$datosUsuario[0]['id_usuario']],$datosRecuperacion);

            /* ENVIAR CORREO A COLABORADOR */
            $this->scripts->correoRecuperacionUsuario($datosUsuario[0]['correo'], $datosUsuario[0]['nombres_apellidos'],$token,$fechaCaducidadToken);

            $message = sprintf($this->mensajeError->msg503, $datosUsuario[0]['usuario']);
            echo $this->alertas->alertaExito($message);
            echo $this->alertas->bootstrap_recuperacion($tokenCifrado);
            //echo $this->alertas->reDireccion($this->items['baseUrl'] . '/inicio', 1);                  
        }        
    }
    
	public function recuperarCuenta($token){
        $data = array (
            'titulo' => 'Restaurar contraseña',
            'token' => $token
        );
        $data = array_merge($data, $this->items);
		return view('dashboard/recuperar-cuenta',$data);
	}

    public function grabarRecuperacion($token){

        /*
        * ----------------------------
        * DATOS DE AJAX PRE PROCESADOS
        * ----------------------------
        */

        $msjError = TRUE;
        $confirmarContrasena = $this->request->getPost('confirmar_contrasena');
        $contrasena = $this->request->getPost('contrasena');

        /*
        * ----------------------------
        * VALIDACIÓN DE REQUERIMIENTOS
        * ----------------------------
        */

        $error = '';
        $error .= $this->complementos->validaCampo($confirmarContrasena, 'required|trim|minlength[1]|maxlength[50]', 'Confirmar contraseña');
        $error .= $this->complementos->validaCampo($contrasena, 'required|trim|minlength[1]|maxlength[50]', 'Contraseña');

        if($contrasena != $confirmarContrasena){
            $error .= "Las contraseñas no coinciden";
        }

        if ($error != '') {
            $message = sprintf($this->mensajeError->msg201, $error);
            echo $this->alertas->alertaError($message);
            EXIT;
        }  
        
		/* VALIDAR SI EL USUARIO EXISTE */
		$whereUsuario = array('token' => $token, 'eliminacion_logica' => 1);		
		$datosUsuario = $this->usuarioModelo->where($whereUsuario)->findAll();
		
		if(empty($datosUsuario)){
			$message = sprintf($this->mensajeError->msg2, 'Token');
			echo $this->alertas->alertaError($message);
			EXIT;
		} else {
            /* VALIDAR SI EL TOKEN HA CADUCADO */
            if(strtotime(date("Y-m-d H:i:s")) > strtotime($datosUsuario[0]['fecha_caducidad_token'])){
                $message = sprintf($this->mensajeError->msg17, 'Token');
                echo $this->alertas->alertaError($message);
                EXIT;
            }        

            $datosRecuperacion = array (
                'contrasena' => md5($contrasena),
                'fecha_cambio_contrasena' => date("Y-m-d H:i:s"),
            );
            $lastId = $this->usuarioModelo->update([$datosUsuario[0]['id_usuario']],$datosRecuperacion);

            $message = sprintf($this->mensajeError->msg503, $datosUsuario[0]['usuario']);
            echo $this->alertas->alertaExito($message);
            echo $this->alertas->reDireccion($this->items['baseUrl'] . '/iniciar-sesion', 1);
        }         
    }
    
    public function salir(){
        $this->session->stop('sesionUsuario');
        $this->session->destroy('sesionUsuario');
        $this->session->remove('sesionUsuario');
        echo $this->alertas->reDireccion($this->items['baseUrl'] . '/', 1);
    }
}
