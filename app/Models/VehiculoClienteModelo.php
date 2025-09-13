<?php namespace App\Models;

use CodeIgniter\Model;

class VehiculoClienteModelo extends Model {
    protected $table = 'vehiculo_cliente';
    protected $primaryKey = 'id_vehiculo_cliente';
    protected $allowedFields = ['id_vehiculo_cliente','vehiculo_id','cliente_id','fecha_registro','eliminacion_logica'];
}
