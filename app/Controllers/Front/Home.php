<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        return view('tables');
    }

    
    public function categorias()
    {
        return view('categorias');
    }

}