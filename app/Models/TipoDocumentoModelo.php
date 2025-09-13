<?php namespace App\Models;

use CodeIgniter\Model;

class TipoDocumentoModelo extends Model {
    protected $table = 'tipo_documento';
    protected $primaryKey = 'id_tipo_documento';
    protected $allowedFields = ['id_tipo_documento','tipo_documento','eliminacion_logica','fecha_registro'];
}
