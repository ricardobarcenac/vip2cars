<?php

namespace App\Libraries;

class Error {
    
    private function cargar(){
        /*
         * LISTADO DE MENSAJES
         * -------------------
         * 1 ~ 200 => Mensajes de error de sistema.
         * 201 ~ 400 => Mensajes de alerta de validaciones.
         * 401 ~ 500 => Mensajes de error en base de datos.
         * 501 ~ 600 => Mensajes de exito
         * 601 ~ 650 => Mensajes de la libreria Files
         */
        $this->message[1] = 'El %s no se encuentra(n) registrado(s).';
        $this->message[2] = 'El %s no existe(n).';
        $this->message[3] = 'El %s no se relaciona(n).';
        $this->message[4] = 'El %s ha superado el periodo de prueba, compre una licencia para seguir usando el sistema.';
        $this->message[5] = 'El %s no cuenta con membresía vigente, renueve su licencia para seguir usando el sistema.';
        $this->message[6] = 'Hubo un error anómalo en el sistema y la ejecucion del proceso.';
        $this->message[7] = 'El %s ya se encuentra(n) registrado(s).';
        $this->message[8] = 'Es necesario ingresar un(a) %s para continuar.';
        $this->message[9] = 'El %s y/o %s no deben de ser iguales.';
        $this->message[10] = 'El %s que se ingreso no es un (int).';
        $this->message[11] = 'El %s que se ingreso no es un (string).';
        $this->message[12] = 'El %s que se ingreso no es un (boolean)';
        $this->message[13] = 'El %s que se ingreso no es un (double/real).';
        $this->message[14] = 'El %s que se ingreso no es un (array).';
        $this->message[15] = 'El %s se encuentra pendiente de aprobación de su pago.';
        $this->message[16] = 'El %s ha superado las dos cotizaciones gratuitas parte del periodo de prueba.';
        $this->message[17] = 'El %s ha caducado, solicite uno nuevo.';
        $this->message[20] = 'El %s ha sido encontrado.';
        $this->message[30] = 'El %s se registro temporalmente.';
        /* */
        $this->message[201] = '%s';
        /* */
        $this->message[501] = 'Acceso correcto, bienvenido %s a su panel.';
        $this->message[502] = 'El proceso fue exitoso al agregar a %s en el sistema.';
        $this->message[503] = 'El proceso fue exitoso al actualizar a %s en el sistema.';
        $this->message[504] = 'El proceso fue exitoso al eliminar a %s en el sistema.';
        $this->message[505] = 'El proceso fue exitoso al anular a %s en el sistema.';
        $this->message[510] = 'Su correo ha sido enviado exitosamente a la cuenta %s.';
        $this->message[511] = 'Su consulta ha sido enviado exitosamente.';
        $this->message[600] = 'Usted ha sido desconectado.';
        /* */
        $this->message[601] = 'Se ha exedido el tamaño permitido.';
        $this->message[602] = 'No existe la ubicación seleccionada.';
        $this->message[605] = 'Archivo subido con exito.';
        return $this->message;
    }
    
    public function msg(){
        $obtieneErrores = $this->cargar();
        if(isset($obtieneErrores) && is_array($obtieneErrores)){
            $datos = new \stdClass;
            foreach($obtieneErrores as $k => $v){
                $obtieneK = 'msg'.$k;
                $datos->$obtieneK = $v.'<br/> '
                        . '<i class="fa fa-bullhorn"></i> '
                        . 'MENSAJE DE ALERTA N°: <b>['.$k.']</b>';
            }
            return $datos;
        } else{
            return FALSE;
        }
    }    
}
