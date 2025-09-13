<?php namespace App\Models;

use CodeIgniter\Model;

class UsuarioModelo extends Model {
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    protected $allowedFields = ['id_usuario','nombres','apellidos','telefono','correo_electronico','usuario','contrasena','perfil_id','token','eliminacion_logica','fecha_registro','fecha_solicitud_recuperacion','fecha_caducidad_token','fecha_cambio_contrasena','fecha_ultimo_inicio_sesion','fecha_eliminacion','fecha_actualizacion'];
}
