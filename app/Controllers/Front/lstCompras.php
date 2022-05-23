<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\ProductosModel;
use App\Models\TemporalComprasModel;
use App\Models\ComprasModel;
use App\Models\DetalleCompraModel;
use App\Models\ConfiguracionModel;


class lstCompras extends BaseController
{
    protected $compras, $productos, $guardar, $detalle_compra;
    public function __construct()
    {
        $this->compras = new TemporalComprasModel();
        $this->productos = new ProductosModel();
        $this->guardar = new ComprasModel();
        $this->detalle_compra = new DetalleCompraModel();
        $this->configuracion = new ConfiguracionModel();
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
            $datos = ['error' => 'El Producto no existe', 'existe' => false,];
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
            $productos = $this->productos->where('id', $id_producto)->first();
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
        $compras = $this->compras->where('id_producto', $id_producto)->first();
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

        /* Borra el temporal de los productos listados */
    public function borraTemporal($codigo)
    {
        $compras = $this->compras->where('codigo', $codigo)->first();
        $id = $compras['id'];
        if ($compras['cantidad'] > 1) {
            $nvaCantidad = $compras['cantidad'] - 1;
            $nvoSubtotal = $nvaCantidad * $compras['precio'];
            $data = [
                'cantidad' => $nvaCantidad,
                'subtotal' => $nvoSubtotal,
            ];
            $this->compras->update($id, $data);
        } else {
            $this->compras->delete($id);
        }

        $this->aumentaInventario($codigo);
        $this->productosTabla();
    }

    public function borraCompra()
    {
        $this->compras->where('folio!=', 0);
        $this->compras->delete();
    }

    public function bajarInventario($id_producto, $cantidad)
    {
        $productos = $this->productos->where('id', $id_producto)->first();
        $id = $productos['id'];
        if ($cantidad <= $productos['existencias']) {
            $data = [
                'existencias' => $productos['existencias'] - $cantidad,
            ];
            $this->productos->update($id, $data);
        } else {
            dd('Error de ingreso de productos');
        }
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

    public function guarda()
    {
        $id_compra = $this->request->getPost('id_compra');
        $total = preg_replace('/[,]/', '', $this->request->getPost('total'));
        $id_usuario =  $this->request->getPost('sesion');
        $resultadoId = $this->guardar->insertaCompra($id_compra, $total, $id_usuario);
        if ($resultadoId) {
            $resultadoCompra = $this->compras->findAll();
            $this->detalle_compra = new DetalleCompraModel();
            foreach ($resultadoCompra as $row) {
                $this->detalle_compra->save([
                    'id_compra' => $resultadoId,
                    'id_producto' => $row['id_producto'],
                    'nombre' => $row['nombre'],
                    'cantidad' => $row['cantidad'],
                    'precio' => $row['precio'],
                ]);
            }
        }
        $this->borraCompra();
        return redirect()->to(base_url() . '/lstCompras/muestraCompraPdf/'.$resultadoId);
    }

    function muestraCompraPdf($id_compra)
    {
        $data['id_compra'] = $id_compra;
        $data['titulo'] = 'Compras';
        return view('compras/ver_compra_pdf', $data);
    }


    function generaCompraPdf($id_compra)
    {
        $datos_compra = $this->guardar->where('id', $id_compra)->first();
        $detalle_compra=$this->detalle_compra->select('*')->where('id_compra', $id_compra)->findAll();
        $nombreTienda = $this->configuracion->select('valor')->where('nombre', 'tienda_nombre')->get()->getRow()->valor;
        $direccionTienda = $this->configuracion->select('valor')->where('nombre', 'tienda_direccion')->get()->getRow()->valor;
        $pdf = new \FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle('Compra');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(195, 5, 'Entrada de productos', 0, 1, 'C');
        $pdf->Ln(27);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->image(base_url() . '/public/logo-alianza.png', 185, 10, 20, 20, 'PNG');
        $pdf->Cell(50, 5, $nombreTienda, 0, 1, 'L');
        $pdf->Cell(20, 5, utf8_decode('Dirección:'), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(5, 5, $direccionTienda, 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(20, 5, utf8_decode('Fecha/Hora:'), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(5, 5, $datos_compra['fecha_alta'], 0, 1, 'L');

        $pdf->Ln(27);

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(0, 51, 102);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(196, 5, 'Detalle de Productos', 1, 1, 'C', 1);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(14, 5, 'No', 1, 0, 'C');
        $pdf->Cell(20, 5, 'Codigo', 1, 0, 'C');
        $pdf->Cell(92, 5, 'Nombre', 1, 0, 'L');
        $pdf->Cell(20, 5, 'Precio', 1, 0, 'C');
        $pdf->Cell(20, 5, 'Cantidad', 1, 0, 'C');
        $pdf->Cell(30, 5, 'Importe', 1, 1, 'C');
        $contador = 1;

        $pdf->SetFont('Arial', '', 8);
        foreach ($detalle_compra as $row) {
            $pdf->Cell(14, 5, $contador, 1, 0, 'C');
            $pdf->Cell(20, 5, $row['id_producto'], 1, 0, 'C');
            $pdf->Cell(92, 5, $row['nombre'], 1, 0, 'L');
            $pdf->Cell(20, 5, '$'.number_format($row['precio'],2,'.',','), 1, 0, 'R');
            $pdf->Cell(20, 5, $row['cantidad'], 1, 0, 'C');
            $importe = '$'.number_format($row['precio'] * $row['cantidad'],2,'.',',');
            $pdf->Cell(30, 5, $importe, 1, 1, 'R');
            $contador++;
        }
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(195,5,'Total $'.number_format($datos_compra['total'],2,'.',','),0,1,'R');


        $this->response->setHeader('Content-type', 'application/pdf');
        $pdf->output("compra_pdf.pdf", "I");
    }

    function muestraComprapdf()
    {
    }
}
