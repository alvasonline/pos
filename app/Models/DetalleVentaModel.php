<?php

namespace  App\Models;
use CodeIgniter\Model;

class DetalleVentaModel extends Model{
    protected $table      = 'detalle_venta';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['id_venta','id_producto','nombre','cantidad','precio'];
    protected $createdField  = 'fecha_alta';
    protected $useTimestamps = false;
}
