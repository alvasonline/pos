<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\ProductosModel;
use App\Models\TemporalComprasModel;
use App\Models\ComprasModel;


class lstCompras extends BaseController
{
    protected $compras, $productos;
    public function __construct()
    {
        $this->compras = new TemporalComprasModel();
        $this->productos = new ProductosModel();
    }
    /* Inicio de la pagina, presentación del contenido */
    public function new()
    {
        $data = ['titulo' => 'Comprar productos'];
        return view('compras/new', $data);
    }

    /* Busqueda del producto que se necesita para comprar */

    public function buscaProducto($id_producto)
    {
        $productos = $this->productos->where('codigo', $id_producto)->first();
        if ($productos) {
            if ($productos['existencias'] > 0) {
                $datos = ['productos' => $productos, 'error' => '', 'existe' => true, 'inventario' => true,];
            } else {
                $datos = ['error' => 'Producto Fuera de Inventario', 'existe' => true, 'inventario' => false,];
            }
        } else {
            $datos = ['error' => 'Producto no existe', 'existe' => false,];
        }
        echo json_encode($datos);
    }

    /*Agrega el Producto a la lista Temporal y baja inventario de Lista principal */
    public function agregaProducto($id_producto, $cantidad)
    {
        $existe = $this->duplicado($id_producto);
        if ($existe) {
            $id = $existe['id'];
            $nuevoSub = $existe['precio'] * $cantidad + $existe['subtotal'];
            $datos = ['cantidad' => $existe['cantidad'] + $cantidad, 'subtotal' => $nuevoSub,];
            $this->compras->update($id, $datos);
        } else {
            $id_compra = uniqid();
            $productos = $this->productos->where('codigo', $id_producto)->first();
            $datos = ['id_producto' => $productos['id'], 'folio' => $id_compra, 'codigo' => $productos['codigo'], 'nombre' => $productos['nombre'], 'cantidad' => $cantidad, 'precio' => $productos['precio_venta'], 'subtotal' => $productos['precio_venta'] * $cantidad,];
            $this->compras->save($datos);
        }
        $this->bajarInventario($id_producto, $cantidad);
        $info = $this->productosTabla();
        return ($info);
    }


    /*Revisa si existe un producto en la tabla temporal para no volverlo a agregar (Trabaja dentro de AgregarProducto()) */
    public function duplicado($id_producto)
    {
        $compras = $this->compras->where('codigo', $id_producto)->first();
        return $compras;
    }

    /* Trae la Tabla de productos y el total de temporales en agregaProducto() */
    public function productosTabla()
    {
        $traer = $this->traerProductos();
        $total = $this->totalProductos();
        $data = [
            'tabla' => $traer,
            'total' => $total,
        ];

        echo json_encode($data);
    }

    /*Crea la tabla de productos que se arega en ProductosTabla() */
    public function traerProductos()
    {
        $compras = $this->compras->findAll();
        if ($compras) {
            $fila = '';
            $num = 0;
            foreach ($compras as $data) {
                $num++;
                $fila .= '<tr>';
                $fila .= '<td>' . $num . '</td>';
                $fila .= '<td>' . $data["codigo"] . '</td>';
                $fila .= '<td>' . $data["nombre"] . '</td>';
                $fila .= '<td class="moneda">' . number_format($data["precio"], 2, '.', ',') . '</td>';
                $fila .= '<td class="moneda">' . $data["cantidad"] . '</td>';
                $fila .= '<td class="moneda">' . number_format($data["subtotal"], 2, '.', ',') . '</td>';
                $fila .= "<td><a onclick='eliminaProducto(\"" . $data['codigo'] . "\")' class='btn btn-danger btn-sm'><i class='fa-solid fa-trash-can text-white'> - 1</i></a></td>";
                $fila .= '</tr>';
            }

            return ($fila);
        }
    }
    /*Totaliza y crea el total del subtotal que se agrega enProductosTabla */
    public function totalProductos()
    {
        $total = 0;
        $compras = $this->compras->findAll();
        if ($compras) {
            foreach ($compras as $subtotal) {
                $total += $subtotal['subtotal'];
            }
            return (number_format($total, 2, '.', ','));
        }
    }

    public function borraTemporal($codigo)
    {
        $compras = $this->compras->where('codigo', $codigo)->first();
        $id = $compras['id'];
        if ($compras['cantidad'] > 1) {
            $nvaCantidad=$compras['cantidad'] - 1;
            $nvoSubtotal=$nvaCantidad * $compras['precio'];
            $data = [
                'cantidad' => $nvaCantidad,
                'subtotal'=>$nvoSubtotal,
            ];
            $this->compras->update($id, $data);
        } else {
            $this->compras->delete($id);
        }

        $this->aumentaInventario($codigo);
        $this->productosTabla();
    }

    public function bajarInventario($id_producto, $cantidad)
    {
        $productos = $this->productos->where('codigo', $id_producto)->first();
        $id = $productos['id'];
        $data = [
            'existencias' => $productos['existencias'] - $cantidad,
        ];
        $this->productos->update($id, $data);
    }

    public function aumentaInventario($id_producto)
    {
        $productos = $this->productos->where('codigo', $id_producto)->first();
        $id = $productos['id'];
        $data = [
            'existencias' => $productos['existencias'] + 1,
        ];
        $this->productos->update($id, $data);
    }
    public function guardaCompra(){
        $compras = new ComprasModel();
        
        $id_compra = uniqid();
        dd($id_compra);
    }
}
