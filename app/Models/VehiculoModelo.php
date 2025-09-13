<?php namespace App\Models;

use CodeIgniter\Model;

class VehiculoModelo extends Model {
    protected $table = 'vehiculo';
    protected $primaryKey = 'id_vehiculo';
    protected $allowedFields = ['id_vehiculo','modelo_id','placa','ano_fabricacion','fecha_registro','eliminacion_logica'];
}
