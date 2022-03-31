<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\CajaModel;

class Caja extends BaseController
{
    protected $conectar;

    public function __construct()
    {
        $this->conectar = new CajaModel();
    }
    
    public function index($activo = 1)
    {
        $conectar = $this->conectar->where("activo", $activo)->findAll();
        $data = ['titulo' => 'Caja', 'datos' => $conectar];
        
        return view('caja/caja', $data);
    }

    public function nuevo()
    {
        $data = ['titulo' => 'Nueva Caja'];
        return view('caja/nuevo', $data);
    }

    public function eliminado($activo = 0)
    {
        $conectar = $this->conectar->where("activo", $activo)->findAll();
        $data = ['titulo' => 'Cajas Desactivadas', 'datos' => $conectar];
        return view('caja/eliminado', $data);
    }


    public function editar($id = null)
    {
        $conectar = $this->conectar->where('id', $id)->first();
        $data = [
            'titulo' => 'Actualizar Caja',
            'datos' => $conectar
        ];
        return view('caja/editar', $data);
    }

    public function guardar()
    {
        $validation = service('validation');
        $validation->setRules([
            'folio' => 'required|alpha_numeric_space|is_unique[caja.folio]|min_length[3]',
            'numero_caja' => 'required|alpha_numeric_space|is_unique[caja.numero_caja]|min_length[3]',
            'nombre' => 'required|string|min_length[3]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        } else {
            $data = [
                'folio' => $this->request->getPost('folio'),
                'nombre' => $this->request->getPost('nombre'),
                'numero_caja' => $this->request->getPost('numero_caja'),
                'titulo' => 'Agregar Caja',
                'guardado' => 'Si',
            ];
            $this->conectar->save($data);
            return view('caja/nuevo', $data);
        } 
    }

    public function actualizar($id = null)
    {
        $validation = service('validation');
        $validation->setRules([
            'folio' => 'required|alpha_numeric_space|min_length[3]',
            'numero_caja' => 'required|alpha_numeric_space|min_length[3]',
            'nombre' => 'required|string|min_length[3]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }else{
            $id = $this->request->getVar('id');
            
            $conectar = $this->conectar->where('id', $id)->first();
            $data = [
                'folio' => $this->request->getPost('folio'),
                'nombre' => $this->request->getPost('nombre'),
                'numero_caja' => $this->request->getPost('numero_caja'),
                'titulo' => 'Actualizar Caja',
                'guardado' => 'Se guardó correctamente la Caja',
                'datos' => $conectar,
            ];
            $this->conectar->update($id, $data);
            return view('caja/editar', $data);
        } 
    }

    public function eliminar($id = null)
    {
        $this->conectar->update($id, ['activo' => 0]);
        return redirect()->to(base_url() . '/caja');
    }

    public function activar($id = null)
    {
        $this->conectar->update($id, ['activo' => 1]);
        return redirect()->to(base_url() . '/caja/eliminado');
    }
}
