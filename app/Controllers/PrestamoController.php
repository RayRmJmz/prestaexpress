<?php

namespace App\Controllers;

use App\Models\PrestamoModel;
use App\Models\PuestoModel;
use App\Models\AbonoModel;

class PrestamoController extends BaseController
{
    public function index()
    {
        $prestamoModel = new PrestamoModel();
        if (session('empleado')->puesto == "Administrador") {
            $data['prestamos'] = $prestamoModel->select('prestamo.*, empleado.emp_nombre')
                ->join('empleado', 'empleado.id_empleado = prestamo.id_empleado')
                ->paginate(25);
        } else {
            $data['prestamos'] = $prestamoModel->select('prestamo.*, empleado.emp_nombre')
            ->join('empleado', 'empleado.id_empleado = prestamo.id_empleado')
            ->where('prestamo.id_empleado', session('empleado')->id_empleado)
                ->paginate(25);
        }
        
        $data['pager'] = $prestamoModel->pager;
        return view('prestamo/index', $data);
    }

    public function solicitud()
    {
        if (session('motivos')) return view('prestamo/solicitudNegada');
        $puestoModel = new PuestoModel();
        $puesto = $puestoModel->select('puesto.*')
            ->join('det_emp_puesto', 'puesto.id_puesto = det_emp_puesto.id_puesto')
            ->where('det_emp_puesto.id_empleado', session('empleado')->id_empleado)
            ->where('det_emp_puesto.fecha_fin is null')
            ->first();
        $data['montoMin'] = $puesto->pst_sueldo;
        $data['montoMax'] = $puesto->pst_sueldo * 6;
        return view('prestamo/solicitud', $data);
    }

    public function registrar()
    {
        $prestamoModel = new PrestamoModel();
        $prestamoModel->insert([
            'fecha_solicitud' => date('Y-m-d'),
            'monto' => $this->request->getPost('monto'),
            'duracion' => $this->request->getPost('duracion'),
            'id_empleado' => session('empleado')->id_empleado,
            'estado' => 'SOLICITUD'
        ]);
        session()->setFlashdata('success', 'Solicitud registrada');
        return redirect()->to(base_url('admin'));
    }

    public function aprobar($id)
    {
        $prestamoModel = new PrestamoModel();
        $prestamoModel->update($id, [
            'estado' => "APROBADO",
            'fecha_aprob' => date('Y-m-d')
        ]);
        session()->setFlashdata('success', 'Solicitud aprobada');
        return redirect()->to(base_url('prestamos'));
    }
    public function eliminar($id)
    {
        $prestamoModel = new PrestamoModel();
        $prestamoModel->delete($id);
        session()->setFlashdata('success', 'Prestamo eliminado');
        return redirect()->to(base_url('prestamos'));
    }

    public function detalles($id)
    {
        $prestamoModel = new PrestamoModel();
        $abonoModel = new AbonoModel();
        $data['prestamo'] = $prestamoModel
            ->select('prestamo.*, empleado.emp_nombre')
            ->join('empleado', 'empleado.id_empleado = prestamo.id_empleado')
            ->find($id);
        $data['abonos'] = $abonoModel
            ->where('id_prestamo', $id)
            ->find();
        $totalAbonoCapital = $abonoModel
            ->selectSum('monto_capital')
            ->where('id_prestamo', $id)->first();
        $resto = $data['prestamo']->monto - $totalAbonoCapital->monto_capital;
        $data['resto'] = number_format($resto, 2);
        return view('prestamo/detalles', $data);
    }
}
