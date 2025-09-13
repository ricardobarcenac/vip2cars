<?php namespace App\Models;

use CodeIgniter\Model;

class ClienteModelo extends Model {
    protected $table = 'cliente';
    protected $primaryKey = 'id_cliente';
    protected $allowedFields = ['id_cliente','tipo_documento_id','numero_documento','nombres','apellidos','telefono','correo_electronico','eliminacion_logica','fecha_registro'];
}
