<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;


class Login extends BaseController
{

    public function index()
    {
        $data = [
            'titulo' => 'Iniciar Sesion'
        ];
        return view('login', $data);
    }
}
