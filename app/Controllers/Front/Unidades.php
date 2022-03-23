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

    public function index($activo = 1)
    {
        $unidades = $this->unidades->where("activo", $activo)->findAll();
        $data = ['titulo' => 'Lista de Unidades', 'datos' => $unidades];
        return view('unidades/unidades', $data);
    }

    public function nuevo()
    {
        $unidades = $this->unidades->getForeignKeyData('productos');
        d($unidades);
        $data = ['titulo' => 'Agregar Unidad', 'tablas' => $unidades];
        return view('unidades/nuevo', $data);
    }

    public function eliminado()
    {
        $data = ['titulo' => 'Unidades Eliminadas'];
        return view('unidades/eliminado', $data);
    }


    public function editar()
    {
        $data = ['titulo' => 'Editar Unidad'];
        return view('unidades/editar', $data);
    }

    public function guardar()
    {
    }

    public function eliminar()
    {
        $data = ['titulo' => 'Eliminar Unidad'];
        return view('unidades/eliminar', $data);
    }
}
