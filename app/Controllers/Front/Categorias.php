<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\CategoriasModel;


class Categorias extends BaseController
{
    protected $categorias;

    public function __construct()
    {
        $this->categorias = new CategoriasModel();
    }

    public function index($activo = 1)
    {
        $categorias = $this->categorias->where("activo", $activo)->findAll();
        $data = ['titulo' => 'Lista de categorias', 'datos' => $categorias];
        return view('categorias/categorias', $data);
    }


    public function eliminado($activo = 0)
    {
        $categorias = $this->categorias->where("activo", $activo)->findAll();
        $data = ['titulo' => 'Lista de categorias Desactivadas', 'datos' => $categorias];
        return view('categorias/eliminado', $data);
    }

    public function nuevo()
    {
        $data = ['titulo' => 'Nueva Categoria'];
        return view('categorias/nuevo', $data);
    }

    public function editar($id = null)
    {
        $categorias = $this->categorias->where('id', $id)->first();
        $data = [
            'titulo' => 'Editar Categoria',
            'datos' => $categorias
        ];
        return view('categorias/editar', $data);
    }

    
    public function guardar()
    {
        if ($this->request->getMethod() == "post" && $this->validate(['nombre' => 'required'])) {
            $data = [
                'nombre' => $this->request->getPost('nombre'),
                'titulo' => 'Agregar Categoria',
                'guardado' => 'Si',
            ];
            $this->categorias->save($data);
            return view('categorias/nuevo', $data);
        } else {
            $data = [
                'error' => 'No pueden existir campos en blanco, por favor llene los campos correctamente',
                'titulo' => 'Agregar Categoria',
            ];
            return view('categorias/nuevo', $data);
        }
    }

    public function actualizar($id = null)
    {
        if ($this->request->getMethod() == "post" && $this->validate(['nombre' => 'required'])) {
            $id = $this->request->getVar('id');
            $categorias = $this->categorias->where('id', $id)->first();
            $data = [
                'nombre' => $this->request->getVar('nombre'),
                'titulo' => 'Actualizar Categoria',
                'guardado' => 'Se guardó correctamente la Categoria',
                'datos' =>  $categorias,
            ];
            $this->categorias->update($id, $data);
            return view('categorias/editar', $data);

        } else {
            $id = $this->request->getVar('id');
            $categorias = $this->categorias->where('id', $id)->first();
            $data = [
                'titulo' => 'Actualizar Categoria',
                'error' => 'No pueden existir campos en blanco, por favor llene los campos correctamente',
                'titulo' => 'Actualizar Categoria',
                'datos' =>  $categorias,
            ];
            return view('categorias/editar', $data);
        }
    }

    public function eliminar($id = null)
    {
        $this->categorias->update($id, ['activo' => 0]);
        return redirect()->to(base_url() . '/categorias');
    }

    public function activar($id = null)
    {
        $this->categorias->update($id, ['activo' => 1]);
        return redirect()->to(base_url() . '/categorias/eliminado');
    }
}
