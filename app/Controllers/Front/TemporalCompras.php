<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\TemporalComprasModel;
use App\Models\ProductosModel;

class TemporalCompras extends BaseController
{
    protected $conectar, $productos, $id_compra;

    public function __construct()
    {
        $this->conectar = new TemporalComprasModel();
        $this->productos = new ProductosModel();
    }

    public function guardar($id_producto, $cantidad)
    {
        $id_compra = uniqid();
        $producto = $this->productos->where('id', $id_producto)->first();
        if ($producto) {
            $datosExiste = $this->porIdProcutoCompra($id_producto);
        
            if ($datosExiste) {
                $id = $datosExiste->id;
                $cantidad = $datosExiste->cantidad + $cantidad;
                $subtotal = $cantidad * $datosExiste->precio;
                $data = [
                    'cantidad' => $cantidad,
                    'subtotal' => $subtotal,
                ];
           

                $this->conectar->update($id,$data);
            } else {
                $subtotal = $cantidad * $producto['precio_compra'];
                $data = [
                    'folio' => $id_compra,
                    'id_producto' => $id_producto,
                    'codigo' => $producto['codigo'],
                    'nombre' => $producto['nombre'],
                    'precio' => $producto['precio_compra'],
                    'cantidad' => $cantidad,
                    'subtotal' => $subtotal,
                    'titulo' => 'Agregar Compra',
                    'guardado' => 'Si',
                ];
                $this->conectar->save($data);
            }
        } else {
            echo 'Error al guardar';
        }
    }

    public function porIdProcutoCompra($id_producto)
    {
        $this->conectar->select('*');
        $this->conectar->where('id_producto', $id_producto);
        $datos = $this->conectar->get()->getRow();
        return $datos;
    }
}
