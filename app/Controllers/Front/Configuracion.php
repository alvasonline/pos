<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\ConfiguracionesModel;

class Configuracion extends BaseController
{
    protected $conectar;

    public function __construct()
    {
        $this->conectar = new ConfiguracionesModel();
    }

    public function index($activo = 1)
    {
        $conectar = $this->conectar->where("activo", $activo)->findAll();
        $data = ['titulo' => 'Lista de Unidades', 'datos' => $conectar];
        return view('configuracion/configuracion', $data);
    }

    public function nuevo()
    {
        $data = ['titulo' => 'Agregar Unidad'];
        return view('configuracion/nuevo', $data);
    }

    public function eliminado($activo = 0)
    {
        $conectar = $this->conectar->where("activo", $activo)->findAll();
        $data = ['titulo' => 'Lista de Unidades Desactivadas', 'datos' => $conectar];
        return view('configuracion/eliminado', $data);
    }


    public function editar($id = null)
    {
        $conectar = $this->conectar->where('id', $id)->first();
        $data = [
            'titulo' => 'Actualizar Unidad',
            'datos' => $conectar
        ];
        return view('configuracion/editar', $data);
    }

    public function guardar()
    {
        $validation = service('validation');
        $validation->setRules([
            'nombre' => 'required|alpha_space|is_unique[configuracion.nombre]|min_length[3]',
            'nombre_corto' => 'required|alpha_space|is_unique[configuracion.nombre_corto]|min_length[3]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        } else {
            $data = [
                'nombre' => $this->request->getPost('nombre'),
                'nombre_corto' => $this->request->getPost('nombre_corto'),
                'titulo' => 'Agregar Unidad',
                'guardado' => 'Si',
            ];
            $this->conectar->save($data);
            return view('configuracion/nuevo', $data);
        } 
    }

    public function actualizar($id = null)
    {
        $validation = service('validation');
        $validation->setRules([
            'nombre' => 'required|alpha_space|is_unique[configuracion.nombre]|min_length[3]',
            'nombre_corto' => 'required|alpha_space|is_unique[configuracion.nombre]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }else{
            $id = $this->request->getVar('id');
            $conectar = $this->conectar->where('id', $id)->first();
            $data = [
                'nombre' => $this->request->getVar('nombre'),
                'nombre_corto' => $this->request->getVar('nombre_corto'),
                'titulo' => 'Actualizar Unidad',
                'guardado' => 'Se guardó correctamente la Unidad',
                'datos' => $conectar,
            ];
            $this->conectar->update($id, $data);
            return view('configuracion/editar', $data);
        } 
    }

    public function eliminar($id = null)
    {
        $this->conectar->update($id, ['activo' => 0]);
        return redirect()->to(base_url() . '/configuracion');
    }

    public function activar($id = null)
    {
        $this->conectar->update($id, ['activo' => 1]);
        return redirect()->to(base_url() . '/configuracion/eliminado');
    }
}
