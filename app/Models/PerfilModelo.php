<?php namespace App\Models;

use CodeIgniter\Model;

class PerfilModelo extends Model {
  protected $table = 'perfil';
  protected $primaryKey = 'id_perfil';
  protected $allowedFields = ['id_perfil','nombre','eliminacion_logica'];
}
