<?php

namespace  App\Models;
use CodeIgniter\Model;

class RealtyModel extends Model{
    protected $table      = 'articulos';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'titulo',
        'informacion',
        'ingresofamiliar',
        'cuartos',
        'precio',
        'imagen',
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = 'fecha_edit';
}



?>