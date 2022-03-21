<?php
namespace App\Controllers\Front;
use App\Controllers\BaseController;
use App\Models\UnidadesModel;

class Unidades extends BaseController
{
protected $unidades;
public function __construct()
{
    $this->unidades = new UnidadesModel();
}
public function index($activo=1)
    {
        $unidades = $this->unidades->where("activo",$activo)->findAll();
        $data = ['titulo' => 'Unidades', 'datos' => $unidades];
        return view('unidades',$data);
    }
}
