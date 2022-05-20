<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\ComprasModel;
use App\Models\DetalleCompraModel;
use App\Models\ConfiguracionModel;


class Compras extends BaseController
{
    protected $compras, $detalle_compra, $configuracion;

    public function __construct()
    {
        $this->compras = new ComprasModel();
        $this->detalle_compra = new DetalleCompraModel();
        $this->configuracion = new ConfiguracionModel();
    }

    public function index($activo = 1)
    {
        $compras = $this->compras->where("activo", $activo)->findAll();
        $data = ['titulo' => 'Lista de Compras', 'datos' => $compras];
        return view('compras/compras', $data);
    }

    public function nuevo()
    {
        return view('compras/nuevo');
    }


    public function eliminado($activo = 0)
    {
        $compras = $this->compras->where("activo", $activo)->findAll();
        $data = ['titulo' => 'Lista de Compras Desactivadas', 'datos' => $compras];
        return view('compras/eliminado', $data);
    }


    public function editar($id = null)
    {
        $compras = $this->compras->where('id', $id)->first();
        $data = [
            'titulo' => 'Actualizar Compra',
            'datos' => $compras
        ];
        return view('compras/editar', $data);
    }

    public function guardar()
    {
        $validation = service('validation');
        $validation->setRules([
            'nombre' => 'required|alpha_space|is_unique[compras.nombre]|min_length[3]',
            'nombre_corto' => 'required|alpha_space|is_unique[compras.nombre_corto]|min_length[3]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        } else {
            $data = [
                'nombre' => $this->request->getPost('nombre'),
                'nombre_corto' => $this->request->getPost('nombre_corto'),
                'titulo' => 'Agregar Compra',
                'guardado' => 'Si',
            ];
            $this->compras->save($data);
            return view('compras/nuevo', $data);
        }
    }

    public function actualizar($id = null)
    {
        $validation = service('validation');
        $validation->setRules([
            'nombre' => 'required|alpha_space|is_unique[compras.nombre]|min_length[3]',
            'nombre_corto' => 'required|alpha_space|is_unique[compras.nombre]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        } else {
            $id = $this->request->getVar('id');
            $compras = $this->compras->where('id', $id)->first();
            $data = [
                'nombre' => $this->request->getVar('nombre'),
                'nombre_corto' => $this->request->getVar('nombre_corto'),
                'titulo' => 'Actualizar Compra',
                'guardado' => 'Se guardó correctamente la Compra',
                'datos' => $compras,
            ];
            $this->compras->update($id, $data);
            return view('compras/editar', $data);
        }
    }

    public function eliminar($id = null)
    {
        $this->compras->update($id, ['activo' => 0]);
        return redirect()->to(base_url() . '/compras');
    }

    public function activar($id = null)
    {
        $this->compras->update($id, ['activo' => 1]);
        return redirect()->to(base_url() . '/compras/eliminado');
    }

    function muestraCompraPdf($id_compra)
    {
        $data['id_compra'] = $id_compra;
        $data['titulo'] = 'Compras';
        return view('compras/ver_compra_pdf', $data);
    }

    function generaCompraPdf($id_compra)
    {
        $datos_compra = $this->compras->where('id', $id_compra)->first();
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
}
