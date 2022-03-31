<?php

namespace  App\Models;
use CodeIgniter\Model;

class CajaModel extends Model{
    protected $table      = 'caja';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['numero_caja', 'nombre','folio','activo'];
    protected $useTimestamps = true;
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = 'fecha_edit';
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}



?>