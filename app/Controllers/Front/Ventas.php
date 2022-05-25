<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\VentasModel;
use App\Models\DetalleCompraModel;

class Ventas extends BaseController
{
    protected $ventas, $detalle_compra, $configuracion;

    public function __construct()
    {
        $this->ventas = new VentasModel();
        $this->detalle_compra = new DetalleCompraModel();
    }

    public function index($activo = 1)
    {
        $ventas = $this->ventas->where("activo", $activo)->findAll();
        $data = ['titulo' => 'Lista de Ventas', 'datos' => $ventas];
        return view('ventas/ventas', $data);
    }

    public function venta($activo=1)
    {
        $ventas = $this->ventas->where('activo',$activo)->findAll();
        $data =['titulo' => 'Caja', 'datos' => $ventas];
        return view('ventas/caja', $data);
    }

    public function eliminado($activo = 0)
    {
        $ventas = $this->ventas->where("activo", $activo)->findAll();
        $data = ['titulo' => 'Lista de Ventas Desactivadas', 'datos' => $ventas];
        return view('ventas/eliminado', $data);
    }

    public function editar($id = null)
    {
        $ventas = $this->ventas->where('id', $id)->first();
        $data = [
            'titulo' => 'Actualizar Compra',
            'datos' => $ventas
        ];
        return view('ventas/editar', $data);
    }

    public function guardar()
    {
        $validation = service('validation');
        $validation->setRules([
            'nombre' => 'required|alpha_space|is_unique[ventas.nombre]|min_length[3]',
            'nombre_corto' => 'required|alpha_space|is_unique[ventas.nombre_corto]|min_length[3]',
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
            $this->ventas->save($data);
            return view('ventas/nuevo', $data);
        }
    }

    public function actualizar($id = null)
    {
        $validation = service('validation');
        $validation->setRules([
            'nombre' => 'required|alpha_space|is_unique[ventas.nombre]|min_length[3]',
            'nombre_corto' => 'required|alpha_space|is_unique[ventas.nombre]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        } else {
            $id = $this->request->getVar('id');
            $ventas = $this->ventas->where('id', $id)->first();
            $data = [
                'nombre' => $this->request->getVar('nombre'),
                'nombre_corto' => $this->request->getVar('nombre_corto'),
                'titulo' => 'Actualizar Compra',
                'guardado' => 'Se guardó correctamente la Compra',
                'datos' => $ventas,
            ];
            $this->ventas->update($id, $data);
            return view('ventas/editar', $data);
        }
    }

    public function eliminar($id = null)
    {
        $this->ventas->update($id, ['activo' => 0]);
        return redirect()->to(base_url() . '/ventas');
    }

    public function activar($id = null)
    {
        $this->ventas->update($id, ['activo' => 1]);
        return redirect()->to(base_url() . '/ventas/eliminado');
    }

    function muestraCompraPdf($id_compra)
    {
        $data['id_compra'] = $id_compra;
        $data['titulo'] = 'Ventas';
        return view('ventas/ver_compra_pdf', $data);
    }    
}
