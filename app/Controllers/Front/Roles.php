<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\RolesModel;

class Roles extends BaseController
{
    protected $conectar;

    public function __construct()
    {
        $this->conectar = new RolesModel();
    }
    
    public function index($activo = 1)
    {
        $conectar = $this->conectar->where("activo", $activo)->findAll();
        $data = ['titulo' => 'Roles', 'datos' => $conectar];
        
        return view('roles/roles', $data);
    }

    public function nuevo()
    {
        $data = ['titulo' => 'Nuevo Rol'];
        return view('roles/nuevo', $data);
    }

    public function eliminado($activo = 0)
    {
        $conectar = $this->conectar->where("activo", $activo)->findAll();
        $data = ['titulo' => 'Cajas Desactivadas', 'datos' => $conectar];
        return view('roles/eliminado', $data);
    }


    public function editar($id = null)
    {
        $conectar = $this->conectar->where('id', $id)->first();
        $data = [
            'titulo' => 'Actualizar Rol',
            'datos' => $conectar
        ];
        return view('roles/editar', $data);
    }

    public function guardar()
    {
        $validation = service('validation');
        $validation->setRules([
            'nombre' => 'required|alpha|min_length[3]|is_unique[roles.nombre]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        } else {
            $data = [
                'nombre' => $this->request->getPost('nombre'),
                'titulo' => 'Agregar Rol',
                'guardado' => 'Si',
            ];
            $this->conectar->save($data);
            return view('roles/nuevo', $data);
        } 
    }

    public function actualizar($id = null)
    {
        $validation = service('validation');
        $validation->setRules([
            'nombre' => 'required|string|min_length[3]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }else{
            $id = $this->request->getVar('id');
            
            $conectar = $this->conectar->where('id', $id)->first();
            $data = [
                'nombre' => $this->request->getPost('nombre'),
                'titulo' => 'Actualizar Rol',
                'guardado' => 'Se guardó correctamente el Rol',
                'datos' => $conectar,
            ];
            $this->conectar->update($id, $data);
            return redirect()->to(base_url() . '/roles/editar/'.$id);
        } 
    }

    public function eliminar($id = null)
    {
        $this->conectar->update($id, ['activo' => 0]);
        return redirect()->to(base_url() . '/roles');
    }

    public function activar($id = null)
    {
        $this->conectar->update($id, ['activo' => 1]);
        return redirect()->to(base_url() . '/roles/eliminado');
    }
}
