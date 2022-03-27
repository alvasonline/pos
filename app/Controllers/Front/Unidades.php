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

    public function eliminado($activo = 0)
    {
        $unidades = $this->unidades->where("activo", $activo)->findAll();
        $data = ['titulo' => 'Lista de Unidades Desactivadas', 'datos' => $unidades];
        return view('unidades/eliminado', $data);
    }


    public function editar($id = null)
    {
        $unidades = $this->unidades->where('id', $id)->first();
        $data = [
            'titulo' => 'Actualizar Unidad',
            'datos' => $unidades
        ];
        return view('unidades/editar', $data);
    }

    public function guardar()
    {
        if ($this->request->getMethod() == "post" && $this->validate(['nombre' => 'required', 'nombre_corto' => 'required'])) {
            $data = [
                'nombre' => $this->request->getPost('nombre'),
                'nombre_corto' => $this->request->getPost('nombre_corto'),
                'titulo' => 'Agregar Unidad',
                'guardado' => 'Si',
            ];
            $this->unidades->save($data);
            return view('unidades/nuevo', $data);
        } else {
            $data = [
                'error' => 'No pueden existir campos en blanco, por favor llene los campos correctamente',
                'titulo' => 'Agregar Unidad',
            ];
            return view('unidades/nuevo', $data);
        }
    }

    public function actualizar($id = null)
    {
        if ($this->request->getMethod() == "post" && $this->validate(['nombre' => 'required', 'nombre_corto' => 'required'])) {
            $id = $this->request->getVar('id');
            $unidades = $this->unidades->where('id', $id)->first();
            $data = [
                'nombre' => $this->request->getVar('nombre'),
                'nombre_corto' => $this->request->getVar('nombre_corto'),
                'titulo' => 'Actualizar Unidad',
                'guardado' => 'Se guardó correctamente la Unidad',
                'datos' => $unidades,
            ];
            $this->unidades->update($id, $data);
            return view('unidades/editar', $data);

        } else {
            $id = $this->request->getVar('id');
            $unidades = $this->unidades->where('id', $id)->first();
            $data = [
                'titulo' => 'Actualizar Unidad',
                'error' => 'No pueden existir campos en blanco, por favor llene los campos correctamente',
                'titulo' => 'Actualizar Unidad',
                'datos' => $unidades,
            ];
            return view('unidades/editar', $data);
        }
    }

    public function eliminar($id = null)
    {
        $this->unidades->update($id, ['activo' => 0]);
        return redirect()->to(base_url() . '/unidades');
    }

    public function activar($id = null)
    {
        $this->unidades->update($id, ['activo' => 1]);
        return redirect()->to(base_url() . '/unidades/eliminado');
    }
}
