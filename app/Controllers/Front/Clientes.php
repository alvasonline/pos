<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\ClientesModel;

class Clientes extends BaseController
{
    protected $conectar;

    public function __construct()
    {
        $this->conectar = new ClientesModel();
    }

    public function index($activo = 1)
    {
        $conectar = $this->conectar->where("activo", $activo)->findAll();
        $data = ['titulo' => 'Lista de Clientes', 'datos' => $conectar];
        return view('clientes/clientes', $data);
    }

    public function nuevo()
    {

        $data = [
            'titulo' => 'Agregar Cliente',
        ];
        return view('clientes/nuevo', $data);
    }

    public function eliminado($activo = 0)
    {
        $conectar = $this->conectar->where("activo", $activo)->findAll();
        $data = ['titulo' => 'Lista de Clientes Desactivados', 'datos' => $conectar];
        return view('clientes/eliminado', $data);
    }


    public function editar($id = null)
    {
        $conectar = $this->conectar->where('id', $id)->first();
        $data = [
            'titulo' => 'Actualizar Cliente',
            'datos' => $conectar,
        ];
        return view('clientes/editar', $data);
    }

    public function guardar()
    {
        $validation = service('validation');
        $validation->setRules([
            'nombre' => 'required|string|min_length[3]',
            'identificacion' => 'required|string|is_unique[clientes.identificacion]|min_length[3]',
            'direccion' => 'required|string',
            'telefono' => 'required|alpha_numeric_space',
            'correo' => 'required|valid_email',
        ]);


        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        } else {
            $data = [
                'nombre' => $this->request->getPost('nombre'),
                'identificacion' => $this->request->getPost('identificacion'),
                'direccion' => $this->request->getPost('direccion'),
                'telefono' => $this->request->getPost('telefono'),
                'correo' => $this->request->getPost('correo'),
                'titulo' => 'Agregar Cliente',
            ];


            $this->conectar->save($data);
            return redirect()->to(base_url() . '/clientes');
        }
    }

    public function actualizar($id = null)

    {
        $validation = service('validation');
        $validation->setRules([
            'nombre' => 'required|string|min_length[3]',
            'identificacion' => 'required|string|min_length[3]',
            'direccion' => 'required|string',
            'telefono' => 'required|alpha_numeric_space',
            'correo' => 'required|valid_email',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        } else {
            $id = $this->request->getVar('id');
            $data = [
                'nombre' => $this->request->getPost('nombre'),
                'identificacion' => $this->request->getPost('identificacion'),
                'direccion' => $this->request->getPost('direccion'),
                'telefono' => $this->request->getPost('telefono'),
                'correo' => $this->request->getPost('correo'),
                'titulo' => 'Agregar Cliente',
            ];
            $this->conectar->update($id, $data);
            return redirect()->to(base_url() . '/clientes');
        }
    }

    public function eliminar($id = null)
    {
        $this->conectar->update($id, ['activo' => 0]);
        return redirect()->to(base_url() . '/clientes');
    }

    public function activar($id = null)
    {
        $this->conectar->update($id, ['activo' => 1]);
        return redirect()->to(base_url() . '/clientes/eliminado');
    }
}
