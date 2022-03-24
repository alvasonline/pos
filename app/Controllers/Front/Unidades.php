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
        return view('unidades/nuevo', $data);
    }

    public function eliminado()
    {
        $data = ['titulo' => 'Unidades Eliminadas'];
        return view('unidades/eliminado', $data);
    }


    public function editar($id = null)
    {
        $unidades = $this->unidades->where('id', $id)->first();
        $data = [
            'titulo' => 'Editar Unidad',
            'datos' => $unidades
        ];
        return view('unidades/editar', $data);
    }

    public function guardartest()
    {
        $data = [
            'nombre' => $this->request->getVar('nombre'),
            'nombre_corto' => $this->request->getVar('nombre_corto'),
            'titulo' => 'Agregar Unidad',
            'guardado' => 'Si',
        ];
        $this->unidades->save($data);
        return view('unidades/nuevo', $data);
    }

    public function guardar($id = null)
    {
        
     
        $id = $this->request->getVar('id');
        if (!$id) {
            $data = [
                'nombre' => $this->request->getVar('nombre'),
                'nombre_corto' => $this->request->getVar('nombre_corto'),
                'titulo' => 'Agregar Unidad',
                'guardado' => 'Si',
            ];
            $this->unidades->save($data);
            return view('unidades/nuevo', $data);
        } else {
            $unidades = $this->unidades->where('id', $id)->first();
            $data = [
                'nombre' => $this->request->getVar('nombre'),
                'nombre_corto' => $this->request->getVar('nombre_corto'),
                'titulo' => 'Agregar Unidad',
                'guardado' => 'Si',
                'datos' => $unidades,
            ];
            $this->unidades->update($id, $data);
            return view('unidades/editar', $data);
            
        }
    }

    public function eliminar($id =null)
    {
        $this->unidadades->where('id',$id)->delete($id);
        return $this->response->redirect('unidades/unidades');
    }
}
