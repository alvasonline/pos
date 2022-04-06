<?php

namespace  App\Models;
use CodeIgniter\Model;

class TemporalComprasModel extends Model{
    protected $table      = 'temporal_compra';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['folio','id_producto','codigo','nombre', 'cantidad', 'precio','subtotal'];
    protected $useTimestamps = false;
    protected $createdField  = '';
}

?>