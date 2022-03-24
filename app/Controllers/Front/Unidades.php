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
        $data = ['titulo' => 'Agregar Unidad'];
        return view('unidades/nuevo',$data);
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
        $data=[
          'nombre' => $this->request->getVar('nombre'),
          'nombre_corto' => $this->request->getVar('nombre_corto'),
          'titulo' => 'Agregar Unidad',
          'guardado' => 'Si',
        ];
        $this->unidades->save($data);
        return view('unidades/nuevo',$data);
    }

    public function eliminar()
    {
        $data = ['titulo' => 'Eliminar Unidad'];
        return view('unidades/eliminar', $data);
    }
}
