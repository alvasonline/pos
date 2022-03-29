<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\ConfiguracionModel;

class Configuracion extends BaseController
{
    protected $conectar;

    public function __construct()
    {
        $this->conectar = new ConfiguracionModel();
    }

    public function index()
    {
        $conectar = $this->conectar->findAll();
        foreach ($conectar as $datos) {
            $datos[$datos['nombre']] = $datos['valor'];
        }
        $data = [
            'titulo' => 'Configuracion de la Tienda',
            'datos' => $datos,
        ];
        dd($datos['tienda_nombre']);

        return view('configuracion/configuracion', $data);
    }


    public function actualizar($id = null)
    {
        $validation = service('validation');
        $validation->setRules(
            [
                'nombre' => 'required|alpha_space|is_unique[configuracion.nombre]|min_length[3]',
                'nombre_corto' => 'required|alpha_space|is_unique[configuracion.nombre]',
            ]
        );

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        } else {
            $id = $this->request->getVar('id');
            $conectar = $this->conectar->where('id', $id)->first();
            $data = [
                'nombre' => $this->request->getVar('nombre'),
                'nombre_corto' => $this->request->getVar('nombre_corto'),
                'titulo' => 'Actualizar Información de la Tienda',
                'datos' => $conectar,
            ];
            $this->conectar->update($id, $data);
            return view('configuracion/editar', $data);
        }
    }
}
