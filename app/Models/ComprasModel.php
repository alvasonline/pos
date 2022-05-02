<?php

namespace  App\Models;
use CodeIgniter\Model;

class ComprasModel extends Model{
    protected $compras;
    protected $table      = 'compras';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['folio','total','id_cajero','activo'];
    protected $useTimestamps = false;
    protected $createdField  = 'fecha_alta';
    
    public function insertaCompra($id_compra,$total,$id_usuario)
    {
        $this->insert([
            'folio' => $id_compra,
            'total' => $total,
            'id_cajero'=>$id_usuario,
            'activo'=>1
        ]); 
        return $this->insertID();
    }
}
