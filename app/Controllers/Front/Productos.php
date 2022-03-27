<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\ProductosModel;

class Productos extends BaseController
{
    protected $productos;

    public function __construct()
    {
        $this->productos = new ProductosModel();
    }

    public function index($activo = 1)
    {
        $productos = $this->productos->where("activo", $activo)->findAll();
        $data = ['titulo' => 'Lista de Productos', 'datos' => $productos];
        return view('productos/productos', $data);
    }

    public function nuevo()
    {
        $data = ['titulo' => 'Agregar Producto'];
        return view('productos/nuevo', $data);
    }

    public function eliminado($activo = 0)
    {
        $productos = $this->productos->where("activo", $activo)->findAll();
        $data = ['titulo' => 'Lista de Productos Desactivados', 'datos' => $productos];
        return view('productos/eliminado', $data);
    }


    public function editar($id = null)
    {
        $productos = $this->productos->where('id', $id)->first();
        $data = [
            'titulo' => 'Actualizar Producto',
            'datos' => $productos
        ];
        return view('productos/editar', $data);
    }

    public function guardar()
    {
        if ($this->request->getMethod() == "post" && $this->validate(['nombre' => 'required', 'nombre_corto' => 'required'])) {
            $data = [
                'nombre' => $this->request->getPost('nombre'),
                'nombre_corto' => $this->request->getPost('nombre_corto'),
                'titulo' => 'Agregar producto',
                'guardado' => 'Si',
            ];
            $this->productos->save($data);
            return view('productos/nuevo', $data);
        } else {
            $data = [
                'error' => 'No pueden existir campos en blanco, por favor llene los campos correctamente',
                'titulo' => 'Agregar Producto',
            ];
            return view('productos/nuevo', $data);
        }
    }

    public function actualizar($id = null)
    {
        if ($this->request->getMethod() == "post" && $this->validate(['nombre' => 'required', 'nombre_corto' => 'required'])) {
            $id = $this->request->getVar('id');
            $productos = $this->productos->where('id', $id)->first();
            $data = [
                'nombre' => $this->request->getVar('nombre'),
                'nombre_corto' => $this->request->getVar('nombre_corto'),
                'titulo' => 'Actualizar Producto',
                'guardado' => 'Se guardó correctamente el producto',
                'datos' => $productos,
            ];
            $this->productos->update($id, $data);
            return view('productos/editar', $data);

        } else {
            $id = $this->request->getVar('id');
            $productos = $this->productos->where('id', $id)->first();
            $data = [
                'titulo' => 'Actualizar Producto',
                'error' => 'No pueden existir campos en blanco, por favor llene los campos correctamente',
                'datos' => $productos,
            ];
            return view('productos/editar', $data);
        }
    }

    public function eliminar($id = null)
    {
        $this->productos->update($id, ['activo' => 0]);
        return redirect()->to(base_url() . '/procuctos');
    }

    public function activar($id = null)
    {
        $this->productos->update($id, ['activo' => 1]);
        return redirect()->to(base_url() . '/productos/eliminado');
    }
}
