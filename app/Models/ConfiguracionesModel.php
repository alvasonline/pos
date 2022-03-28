<?php

namespace  App\Models;
use CodeIgniter\Model;

class ConfiguracionesModel extends Model{
    protected $table      = 'configuracion';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['tienda_nombre', 'tienda_rfc','tienda_telefono','tienda_email', 'tienda_direccion'];
    protected $useTimestamps = true;
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = 'fecha_edit';
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}



?>