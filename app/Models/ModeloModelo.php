<?php namespace App\Models;

use CodeIgniter\Model;

class ModeloModelo extends Model {
    protected $table = 'modelo';
    protected $primaryKey = 'id_modelo';
    protected $allowedFields = ['id_modelo','marca_id','modelo','fecha_registro','eliminacion_logica'];
}
