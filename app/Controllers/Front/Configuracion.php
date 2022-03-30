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
        $data = [
            'titulo' => 'Configuracion de la Tienda',
            'tienda_nombre' => $conectar[0]['valor'],
            'tienda_rfc' => $conectar[1]['valor'],
            'tienda_telefono' => $conectar[2]['valor'],
            'tienda_email' => $conectar[3]['valor'],
            'tienda_direccion' => $conectar[4]['valor'],
            'ticket_leyenda' => $conectar[5]['valor'],
        ];

        return view('configuracion/configuracion', $data);
    }


    public function actualizar($id = null)
    {
        $validation = service('validation');
        $validation->setRules(
            [
                'tienda_nombre' => 'required|string|min_length[3]',
                'tienda_rfc' => 'required|string|min_length[3]',
                'tienda_telefono' => 'required',
                'tienda_email' => 'required|valid_email',
                'tienda_direccion' => 'required|min_length[10]',
                'ticket_leyenda' => 'required|min_length[10]',
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
                'guardado' => 'La información se ha guardado correctamente',
            ];
            $this->conectar->update($id, $data);
            return view('configuracion/configuracion', $data);
        }
    }
}
