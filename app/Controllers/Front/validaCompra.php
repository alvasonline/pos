<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\ProductosModel;
use App\Models\TemporalComprasModel;

class validaCompra extends BaseController
{
    protected $productos, $temporal;

    public function __construct()
    {
        $this->compras = new ProductosModel();
        $this->temporal = new TemporalComprasModel();
    }
    /*---------------- Se Agrega a la lista de productos por comprar */
    public function agregarLista($id_producto, $cantidad)
    {
        $cantidades = $this->validarCantidad($id_producto, $cantidad);
        if ($cantidades) {
            $existe = $this->validarDuplicado($id_producto);
            if ($existe) {
                $temporal = $this->temporal->where('id_producto', $id_producto)->first();
                $nvoStotal = $temporal['precio'] * $cantidad;
                $id = $temporal['id'];
                $datos = [
                    'cantidad' => $temporal['cantidad'] + $cantidad,
                    'subtotal' => $temporal['subtotal'] + $nvoStotal,
                ];
                $this->disminuyeInventario($id_producto, $cantidad);
                $this->temporal->update($id, $datos);
            } else {
                $compras = $this->compras->where('id', $id_producto)->first();
                $id_compra = uniqid();
                $datos = [
                    'id_producto' => $compras['id'],
                    'folio' => $id_compra,
                    'codigo' => $id_producto,
                    'nombre' => $compras['nombre'],
                    'cantidad' => $cantidad,
                    'precio' => $compras['precio_compra'],
                    'subtotal' => $cantidad * $compras['precio_compra'],
                ];
                $this->disminuyeInventario($id_producto, $cantidad);
                $this->temporal->save($datos);
            }
        } else {
            return 'La cantidad es incosistente con el inventario';
        }
    }
    /*---------------- Se valida si el producto está duplicado */
    public function validarDuplicado($id_producto)
    {
        $temporal = $this->temporal->where('id_producto', $id_producto)->first();
        if ($temporal) {
            return true;
        } else {
            return false;
        }
    }
    /*---------------- Se valida la cantidad para no ingresar mas o menos del inventario */
    public function validarCantidad($id_producto, $cantidad)
    {
        $compras = $this->compras->where('id', $id_producto)->first();
        if ($cantidad > $compras['existencias'] || $cantidad <= 0) {
            return false;
        } else {
            return true;
        }
    }

    /*---------------- Disminuye el inventario de productos */
    public function disminuyeInventario($id_producto, $cantidad)
    {
        $compras = $this->compras->where('id', $id_producto)->first();
        if ($compras) {
            if ($cantidad > $compras['existencias'] || $cantidad <= 0) {
                return 'La cantidad es incosistente con el inventario';
            } else {
                $datos = [
                    'existencias' => $compras['existencias'] - $cantidad,
                ];
                $this->compras->update($id_producto, $datos);
            }
        }
    }
    /*---------------- Aumenta el inventario de productos */
    public function aumentaInventario($id_producto, $cantidad)
    {
        $compras = $this->compras->where('id', $id_producto)->first();
        if ($compras) {
            if ($cantidad > $compras['existencias'] || $cantidad <= 0) {
                return 'La cantidad es incosistente con el inventario';
            } else {
                $datos = [
                    'existencias' => $compras['existencias'] + 1,
                ];
                $this->compras->update($id_producto, $datos);
            }
        }
    }
    function muestraTemporal()
    {
        $temporal = $this->temporal->findAll();
        foreach($temporal as $tabla){
            dd($tabla['id']);
        }
    }
}
