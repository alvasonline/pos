<?php

namespace  App\Models;

use CodeIgniter\Model;
use App\Entities\ConfiguracionEntiti;

class ConfiguracionModel extends Model
{
    protected $table      = 'configuracion';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    /*  protected $returnType     = ConfiguracionEntiti::class; */
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $useSoftUpdates = false;
    protected $useSoftCreates = false;
    protected $allowedFields = ['nombre', 'valor'];
    protected $useTimestamps = false;
}
