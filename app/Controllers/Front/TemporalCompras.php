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
        $error='';
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
                /* dd($id, $data); */
                $this->conectar->update($id, $data);
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
            $error = 'Error al guardar';
        }
        $res['datos'] = $this->cargaProductos($id_compra);
        $res['total'] = number_format($this->totalProductos($id_compra),2,'.',',');
        $res['error'] = $error;
   
        echo json_encode($res);
    }

    public function porIdProcutoCompra($id_producto)
    {
        $this->conectar->select('*');
        $this->conectar->where('id_producto', $id_producto);
        $datos = $this->conectar->get()->getRow();
        return $datos;
    }

    public function cargaProductos($id_compra)
    {
        $resultado = $this->porCompra();
        $fila = '';
        $numFila = 0;

        foreach ($resultado as $row) {
            $numFila++;
            $fila .= "<tr id='fila" . $numFila . "'>";
            $fila .= "<td>" . $numFila . "</td>";
            $fila .= "<td>" . $row['folio'] . "</td>";
            $fila .= "<td>" . $row['nombre'] . "</td>";
            $fila .= "<td>" . $row['precio'] . "</td>";
            $fila .= "<td class='tbl_cantidad' id='tbl_cantidad'>" . $row['cantidad'] . "</td>";
            $fila .= "<td class='tbl_subtotal' id='tbl_subtotal'>" . $row['subtotal'] . "</td>";
            $fila .= "<td><a onclick=\"eliminaproducto(" . $row['id_producto'] . ", " . $id_compra . ")\" class='borrar btn btn-danger btn-sm'><i class='fa-solid fa-trash'></i></a></td>";
            $fila .= "</tr>";
        }
        return $fila;
    }

    public function porCompra()
    {
        $this->conectar->select('*');
        $datos = $this->conectar->findAll();
        return $datos;
    }

    public function totalProductos($id_compra)
    {
        $resultado = $this->porCompra($id_compra);
        $total = 0;
        foreach ($resultado as $row) {
            $total += $row['subtotal'];
        }
        return $total;
    }
}
