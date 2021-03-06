<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\ProductosModel;
use App\Models\CategoriasModel;
use App\Models\UnidadesModel;

class Productos extends BaseController
{
    protected $productos;

    public function __construct()
    {
        $this->productos = new ProductosModel();
        $this->categorias = new CategoriasModel();
        $this->unidades = new UnidadesModel();
    }

    public function index($activo = 1)
    {
        $productos = $this->productos->where("activo", $activo)->findAll();
        $data = ['titulo' => 'Lista de Productos', 'datos' => $productos];
        return view('productos/productos', $data);
    }

    public function nuevo()
    {

        $categorias = $this->categorias->where("activo", 1)->findAll();
        $unidades = $this->unidades->where("activo", 1)->findAll();

        $data = [
            'titulo' => 'Agregar Producto',
            'categorias' => $categorias,
            'unidades' => $unidades,
        ];
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
        $categorias = $this->categorias->where("activo", 1)->findAll();
        $unidades = $this->unidades->where("activo", 1)->findAll();
        $data = [
            'titulo' => 'Actualizar Producto',
            'datos' => $productos,
            'categorias' => $categorias,
            'unidades' => $unidades,
        ];
        return view('productos/editar', $data);
    }

    public function guardar()
    {
        $validation = service('validation');
        $validation->setRules([
            'codigo' => 'required|alpha_numeric_space|is_unique[productos.codigo]|min_length[3]',
            'nombre' => 'required|alpha_numeric_space|is_unique[productos.nombre]|min_length[3]',
            'precio_venta' => 'required|decimal',
            'precio_compra' => 'required|decimal',
            'existencia' => 'required|integer',
            'stock_minimo' => 'required|integer',
            'inventariable' => 'required',
            'unidades' => 'required',
            'categorias' => 'required',
        ]);


        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        } else {
            $data = [
                'codigo' => $this->request->getPost('codigo'),
                'nombre' => $this->request->getPost('nombre'),
                'precio_venta' => $this->request->getPost('precio_venta'),
                'precio_compra' => $this->request->getPost('precio_compra'),
                'existencias' => $this->request->getPost('existencia'),
                'stock_minimo' => $this->request->getPost('stock_minimo'),
                'inventariable' => $this->request->getPost('inventariable'),
                'id_unidad' => $this->request->getPost('unidades'),
                'id_categoria' => $this->request->getPost('categorias'),
                'titulo' => 'Agregar Producto',
            ];
            

            $this->productos->save($data);
            return redirect()->to(base_url() . '/productos');
        } 
    }

    public function actualizar($id = null)
    {
        $validation = service('validation');
        $validation->setRules([
            'codigo' => 'required|alpha_numeric_space|min_length[3]',
            'nombre' => 'required|alpha_numeric_space|min_length[3]',
            'precio_venta' => 'required|decimal',
            'precio_compra' => 'required|decimal',
            'existencia' => 'required|integer',
            'stock_minimo' => 'required|integer',
            'inventariable' => 'required',
            'unidades' => 'required',
            'categorias' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }else{
            $id = $this->request->getVar('id');
            $productos = $this->productos->where('id', $id)->first();
            $data = [
                'codigo' => $this->request->getPost('codigo'),
                'nombre' => $this->request->getPost('nombre'),
                'precio_venta' => $this->request->getPost('precio_venta'),
                'precio_compra' => $this->request->getPost('precio_compra'),
                'existencias' => $this->request->getPost('existencia'),
                'stock_minimo' => $this->request->getPost('stock_minimo'),
                'inventariable' => $this->request->getPost('inventariable'),
                'id_unidad' => $this->request->getPost('unidades'),
                'id_categoria' => $this->request->getPost('categorias'),
                'titulo' => 'Agregar Producto',
            ];
            $this->productos->update($id, $data);
            return redirect()->to(base_url() . '/productos');
        } 
    }


    public function eliminar($id = null)
    {
        $this->productos->update($id, ['activo' => 0]);
        return redirect()->to(base_url() . '/productos');
    }

    public function activar($id = null)
    {
        $this->productos->update($id, ['activo' => 1]);
        return redirect()->to(base_url() . '/productos/eliminado');
    }
}

 