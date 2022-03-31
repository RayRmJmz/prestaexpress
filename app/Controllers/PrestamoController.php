<?php

namespace App\Controllers;

use App\Models\PrestamoModel;
use App\Models\PuestoModel;

class PrestamoController extends BaseController
{
    public function index()
    {
        $prestamoModel = new PrestamoModel();
        $data['prestamos'] = $prestamoModel->select('prestamo.*, empleado.emp_nombre')
            ->join('empleado', 'empleado.id_empleado = prestamo.id_empleado')
            ->paginate(25);
        $data['pager'] = $prestamoModel->pager;
        return view('prestamo/index', $data);
    }

    public function solicitud()
    {
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
}
