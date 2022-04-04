<?php

namespace  App\Models;
use CodeIgniter\Model;

class ComprasModel extends Model{
    protected $table      = 'compras';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['folio','total','id_cajero','activo'];
    protected $useTimestamps = true;
    protected $createdField  = 'fecha_alta';
}

?>