<?php namespace App\Models;

use CodeIgniter\Model;

class MarcaModelo extends Model {
    protected $table = 'marca';
    protected $primaryKey = 'id_marca';
    protected $allowedFields = ['id_marca','marca','fecha_registro','eliminacion_logica'];
}
