<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;
use App\Models\RolesModel;
use App\Models\CajasModel;

class Usuarios extends BaseController
{
    protected $conectar;

    public function __construct()
    {
        $this->conectar = new UsuariosModel();
        $this->caja = new CajasModel();
        $this->roles = new RolesModel();
    }

    public function index($activo = 1)
    {
        $conectar = $this->conectar->where("activo", $activo)->findAll();
        $data = ['titulo' => 'Lista de Usuarios', 'datos' => $conectar];
        return view('usuarios/usuarios', $data);
    }

    public function nuevo()
    {
        $roles = $this->roles->where("activo", 1)->findAll();
        $cajas = $this->caja->where("activo", 1)->findAll();
        $data = [
            'titulo' => 'Agregar Usuario',
            'roles'=>$roles,
            'cajas'=>$cajas,
        ];
        return view('usuarios/nuevo', $data);
    }

    public function eliminado($activo = 0)
    {
        $conectar = $this->conectar->where("activo", $activo)->findAll();
        $data = ['titulo' => 'Lista de Usuarios Desactivados', 'datos' => $conectar];
        return view('usuarios/eliminado', $data);
    }


    public function editar($id = null)
    {
        $roles = $this->roles->where("activo", 1)->findAll();
        $cajas = $this->caja->where("activo", 1)->findAll();
        $conectar = $this->conectar->where('id', $id)->first();
        $data = [
            'titulo' => 'Actualizar Usuario',
            'datos' => $conectar,
            'roles'=>$roles,
            'cajas'=>$cajas,
        ];
        return view('usuarios/editar', $data);
    }

    public function guardar()
    {
        $validation = service('validation');
        $validation->setRules([
            'usuario' => 'required|string|min_length[3]',
            'password' => 'required|string|min_length[3]',
            'nombre' => 'required|string|min_length[3]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
           
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        } else {

            $data = [
                'usuario' => $this->request->getPost('usuario'),
                'password' => $this->request->getPost('password'),
                'nombre' => $this->request->getPost('nombre'),
                'id_rol' => $this->request->getPost('rol'),
                'id_caja' => $this->request->getPost('caja'),
            ];

            $this->conectar->save($data);
            return redirect()->to(base_url() . '/usuarios');
        }
    }

    public function actualizar($id = null)
      {
          
        $validation = service('validation');
        $validation->setRules([
            'usuario' => 'required|string|min_length[3]',
            'password' => 'required|string|min_length[3]',
            'nombre' => 'required|string|min_length[3]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        } else {
            $id = $this->request->getVar('id');
            $data = [
                'usuario' => $this->request->getPost('usuario'),
                'password' => $this->request->getPost('password'),
                'nombre' => $this->request->getPost('nombre'),
                'id_rol' => $this->request->getPost('rol'),
                'id_caja' => $this->request->getPost('caja'),
            ];
            $this->conectar->update($id, $data);
            return redirect()->to(base_url().'/Front/editarusuario/'.$id);
        }
    }

    public function eliminar($id = null)
    {
        $this->conectar->update($id, ['activo' => 0]);
        return redirect()->to(base_url() . '/usuarios');
    }

    public function activar($id = null)
    {
        $this->conectar->update($id, ['activo' => 1]);
        return redirect()->to(base_url() . '/usuarios/eliminado');
    }
}
