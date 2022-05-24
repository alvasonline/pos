<?php

namespace  App\Models;
use CodeIgniter\Model;

class VentasModel extends Model{
    protected $compras;
    protected $table      = 'ventas';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['folio','total','id_usuario','id_caja','id_cliente','forma_pago'];
    protected $useTimestamps = false;
    protected $createdField  = 'fecha_alta';
    
    public function insertaCompra($id_compra,$total,$id_usuario,$id_caja, $id_cliente,$forma_pago)
    {
        $this->insert([
            'folio' => $id_compra,
            'total' => $total,
            'id_usuario'=>$id_usuario,
            'id_caja'=>$id_caja,
            'id_cliente'=>$id_cliente,
            'forma_pago'=>$forma_pago,
        ]); 
        return $this->insertID();
    }
}
