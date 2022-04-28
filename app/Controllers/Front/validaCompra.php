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

    /*---------------- buscar los producto para agregar a la lista */
    public function buscarProducto($id)
    {
        $compras = $this->compras->where('id', $id)->first();
        if ($compras) {
            if ($compras['existencias'] > 0) {
                $datos = [
                    'id' => $compras['id'],
                    'codigo' => $compras['codigo'],
                    'nombre' => $compras['nombre'],
                    'precio_compra' => $compras['precio_compra'],
                    'error' => '',
                    'agregar' => true
                ];
                return $datos;
            } else {
                $datos['error'] = 'producto fuera de inventario';
                $datos['agregar'] = false;
                return $datos;
            }
        } else {
            $datos['error'] = 'No existe el producto';
            $datos['agregar'] = false;
            return $datos;
        }
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

    /*---------------- Borrar de la lista y disminuye
    del inventario de productos */
    public function borraTemporal($id_producto)
    {
        $temporal = $this->temporal->where('id_producto', $id_producto)->first();
        $compras = $this->compras->where('id', $id_producto)->first();
        if($temporal){
            $id=$temporal['id'];
        if ($temporal['cantidad'] > 1 && $compras['existencias'] > 0) {
            $nvaCantidad = $temporal['cantidad'] - 1;
            $data = [
                'cantidad' => $nvaCantidad,
                'subtotal' => $nvaCantidad * $temporal['precio']
            ];
            $this->temporal->update($id,$data);
            $this->aumentaInventario($id_producto);
        }else{
            $this->temporal->delete($id);
            $this->aumentaInventario($id_producto);
        }
    }else{
            dd('Error');
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
                $datos['existencias'] = $compras['existencias'] - 1;
                $this->compras->update($id_producto, $datos);
            }
        }
    }
    /*---------------- Aumenta el inventario de productos */
    public function aumentaInventario($id_producto)
    {
        $compras = $this->compras->where('id', $id_producto)->first();
        if ($compras) {
            $datos = [
                'existencias' => $compras['existencias'] + 1,
            ];
            $this->compras->update($id_producto, $datos);
        }
    }
    function muestraTemporal()
    {
        $fila = '';
        $num = 0;
        $temporal = $this->temporal->findAll();
        foreach ($temporal as $tabla) {
            $num++;
            $fila .= '<tr>';
            $fila .= '<td>' . $num . '</td>';
            $fila .= '<td>' . $tabla['codigo'] . '</td>';
            $fila .= '<td>' . $tabla['nombre'] . '</td>';
            $fila .= '<td>' . $tabla['cantidad'] . '</td>';
            $fila .= '<td>' . number_format($tabla['precio'], 2, '.', ',') . '</td>';
            $fila .= '<td>.' . number_format($tabla['subtotal'], 2, '.', ',') . '</td>';
            $fila .= '</tr>';
        }
        return ($fila);
    }
}
