<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\ProductosModel;
use App\Models\TemporalComprasModel;


class lstCompras extends BaseController
{
    protected $compras, $productos;

    public function __construct()
    {
        $this->compras = new TemporalComprasModel();
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
                $datos = [
                    'productos' => $productos,
                    'error' => '',
                    'existe' => true,
                    'inventario' => true,
                ];
            } else {
                $datos = [
                    'error' => 'Producto Fuera de Inventario',
                    'existe' => true,
                    'inventario' => false,
                ];
            }
        } else {
            $datos = [
                'error' => 'Producto no existe',
                'existe' => false,
            ];
        }
        echo json_encode($datos);
    }

    public function agregaProducto($id_producto, $cantidad)
    {

        $existe = $this->duplicado($id_producto);
        if($existe){
            $nuevoSub = $existe['precio_venta'] * $cantidad + $existe['subtotal'];
            $datos=[
                'cantidad' => $existe['cantidad'] + $cantidad,
                'subtotal' => $existe
            ];
        }

        $id_compra = uniqid();
        $productos = $this->productos->where('codigo', $id_producto)->first();
        $datos = [
            'id_producto' => $productos['id'],
            'folio' => $id_compra,
            'codigo' => $productos['codigo'],
            'nombre' => $productos['nombre'],
            'cantidad' => $cantidad,
            'precio' => $productos['precio_venta'],
            'subtotal' => $productos['precio_venta'] * $cantidad,
        ];
        $this->compras->save($datos);
    }
    
    public function duplicado($id_producto){
    $compras = $this->compras->where('codigo',$id_producto)->first();
   
    return $compras;
    
    }
}
