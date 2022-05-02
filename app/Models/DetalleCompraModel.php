<?php

namespace  App\Models;
use CodeIgniter\Model;

class DetalleCompraModel extends Model{
    protected $table      = 'detalle_compra';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['id_compra','id_producto','nombre','cantidad','precio'];
    protected $useTimestamps = false;
    protected $createdField  = 'fecha_alta';
}
