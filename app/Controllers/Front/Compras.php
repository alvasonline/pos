<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\ComprasModel;

class Compras extends BaseController
{
    protected $conectar;

    public function __construct()
    {
        $this->conectar = new ComprasModel();
    }

    public function index($activo = 1)
    {
        $conectar = $this->conectar->where("activo", $activo)->findAll();
        $data = ['titulo' => 'Lista de Compras', 'datos' => $conectar];
        return view('compras/compras', $data);
    }

    public function nuevo()
    {
        return view('compras/nuevo');
    }

    public function eliminado($activo = 0)
    {
        $conectar = $this->conectar->where("activo", $activo)->findAll();
        $data = ['titulo' => 'Lista de Compras Desactivadas', 'datos' => $conectar];
        return view('compras/eliminado', $data);
    }


    public function editar($id = null)
    {
        $conectar = $this->conectar->where('id', $id)->first();
        $data = [
            'titulo' => 'Actualizar Compra',
            'datos' => $conectar
        ];
        return view('compras/editar', $data);
    }

    public function guardar()
    {
        $validation = service('validation');
        $validation->setRules([
            'nombre' => 'required|alpha_space|is_unique[compras.nombre]|min_length[3]',
            'nombre_corto' => 'required|alpha_space|is_unique[compras.nombre_corto]|min_length[3]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        } else {
            $data = [
                'nombre' => $this->request->getPost('nombre'),
                'nombre_corto' => $this->request->getPost('nombre_corto'),
                'titulo' => 'Agregar Compra',
                'guardado' => 'Si',
            ];
            $this->conectar->save($data);
            return view('compras/nuevo', $data);
        }
    }

    public function actualizar($id = null)
    {
        $validation = service('validation');
        $validation->setRules([
            'nombre' => 'required|alpha_space|is_unique[compras.nombre]|min_length[3]',
            'nombre_corto' => 'required|alpha_space|is_unique[compras.nombre]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        } else {
            $id = $this->request->getVar('id');
            $conectar = $this->conectar->where('id', $id)->first();
            $data = [
                'nombre' => $this->request->getVar('nombre'),
                'nombre_corto' => $this->request->getVar('nombre_corto'),
                'titulo' => 'Actualizar Compra',
                'guardado' => 'Se guardó correctamente la Compra',
                'datos' => $conectar,
            ];
            $this->conectar->update($id, $data);
            return view('compras/editar', $data);
        }
    }

    public function eliminar($id = null)
    {
        $this->conectar->update($id, ['activo' => 0]);
        return redirect()->to(base_url() . '/compras');
    }

    public function activar($id = null)
    {
        $this->conectar->update($id, ['activo' => 1]);
        return redirect()->to(base_url() . '/compras/eliminado');
    }
}
