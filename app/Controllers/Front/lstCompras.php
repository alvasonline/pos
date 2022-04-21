<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\ProductosModel;
use App\Models\ComprasModel;


class lstCompras extends BaseController
{
    protected $compras, $productos;

    public function __construct()
    {
        $this->compras = new ComprasModel();
        $this->productos = new ProductosModel();
    }

    public function new()
    {

        $data = [
            'titulo' => 'Comprar productos',
        ];

        return view('compras/new', $data);
    }

    public function buscaProducto($id_producto)
    {
        $productos = $this->productos->where('codigo', $id_producto)->first();

        if ($productos) {
            if ($productos['existencias'] > 0) {
                $datos=[
                    'productos' =>$productos,
                    'error' =>''
                ];
                d($datos);
            } else {
                $datos=[
                    'error' => 'Producto Fuera de Inventario'
                ];
                d($datos);
            }
        } else {
            dd('No existe el producto');
        }
        echo json_encode($datos);
    }
}
