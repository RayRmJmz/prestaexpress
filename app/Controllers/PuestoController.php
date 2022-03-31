<?php

namespace App\Controllers;

use App\Models\PuestoModel;

class PuestoController extends BaseController
{
    public function index()
    {
        // nueva instancia del modelo Puesto
        $puestoModel = new puestoModel();
        // Obtener todos los puestos de la bd
        $data['puestos'] = $puestoModel->paginate(15);
        // Generar links de paginación 
        $data['pager'] = $puestoModel->pager;
        return view('puesto/index', $data);
    }

    public function crear()
    {
        return view('puesto/crear');
    }

    public function registrar()
    {
        $puestoModel = new PuestoModel();

        $puestoModel->insert([
            'pst_nombre' => $this->request->getPost('pst_nombre'),
            'pst_sueldo' => $this->request->getPost('pst_sueldo')
        ]);

        session()->setFlashdata('success', 'El puesto fue registrado');

        return redirect()->to(base_url('puestos'));
    }

    public function editar($id)
    {
        $puestoModel =  new PuestoModel();
        $data['puesto'] = $puestoModel->find($id);
        return view('puesto/editar', $data);
    }

    public function actualizar($id)
    {
        $puestoModel = new PuestoModel();

        $puestoModel->update($id, [
            'pst_nombre' => $this->request->getPost('pst_nombre'),
            'pst_sueldo' => $this->request->getPost('pst_sueldo')
        ]);

        session()->setFlashdata('success', 'El puesto fue actualizado');

        return redirect()->to(base_url('puestos'));
    }

    public function eliminar($id)
    {
        $puestoModel = new PuestoModel();
        $puestoModel->delete($id);
        session()->setFlashdata('success', 'El puesto fue eliminado');
        return redirect()->to(base_url('puestos'));
    }
}
