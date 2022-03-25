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
        $data = ['titulo' => 'Agregar Unidad'];
        return view('categorias/nuevo', $data);
    }

    public function editar($id = null)
    {
        $categorias = $this->categorias->where('id', $id)->first();
        $data = [
            'titulo' => 'Editar Unidad',
            'datos' => $categorias
        ];
        return view('categorias/editar', $data);
    }

    public function guardar($id = null)
    {
        $id = $this->request->getVar('id');
        
if($this->request->getMethod() == "POST" && $this->validate(['nombre'=>'required', 'nombre_corto'=> 'required'])){
        if (!$id) {
            $data = [
                'nombre' => $this->request->getPost('nombre'),
                'nombre_corto' => $this->request->getPost('nombre_corto'),
                'titulo' => 'Agregar Unidad',
                'guardado' => 'Si',
            ];
            $this->categorias->save($data);
            return view('categorias/nuevo', $data);
        } else {
            $categorias = $this->categorias->where('id', $id)->first();
            $data = [
                'nombre' => $this->request->getVar('nombre'),
                'nombre_corto' => $this->request->getVar('nombre_corto'),
                'titulo' => 'Agregar Unidad',
                'guardado' => 'Si',
                'datos' => $categorias,
            ];
            $this->categorias->update($id, $data);
            return redirect()->to(base_url() . '/categorias');
        }
    }else{
        $data=[
            'titulo' => 'Agregar Unidad',
            'error' =>' No Se ha agregado la Categoria por <strong>Falta de información</strong>',
        ];
        return view('categorias/nuevo', $data);

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
