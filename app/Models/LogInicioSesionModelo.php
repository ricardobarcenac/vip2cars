<?php namespace App\Models;

use CodeIgniter\Model;

class LogInicioSesionModelo extends Model {
    protected $table = 'log_inicio_sesion';
    protected $primaryKey = 'log_inicio_sesion';
    protected $allowedFields = ['log_inicio_sesion','ip','usuario_id','usuario','contrasena','agente','estado','data','mensaje','origen','fecha_registro','eliminacion_logica'];
}
