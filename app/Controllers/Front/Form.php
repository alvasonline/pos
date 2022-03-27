<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\ValidarModel;

class Form extends BaseController
{


    protected $conectar;

    public function __construct()
    {
        $this->conectar = new ValidarModel();
    }

    public function verformulario()
    {
        $data = [
            'titulo' => 'Validar las categorias'
        ];
        return view('validar/validacion', $data);
    }

    public function vld()
    {
        $validation = service('validation');
        $validation->setRules([
            'nombre' => 'required|alpha_space|is_unique[categorias.nombre]|min_length[3]',
        ]);
        if(!$validation->withRequest($this->request)->run()){
          /*  dd($validation->getErrors()); */
          return redirect()->back()->withInput()->with('errors',$validation->getErrors());
        }
      
    }
}
