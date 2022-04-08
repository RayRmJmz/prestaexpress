<?php

namespace App\Controllers;

use App\Models\PrestamoModel;
use App\Models\AbonoModel;


class AbonoController extends BaseController
{
    public function index($id_prestamo)
    {
        $prestamoModel = new PrestamoModel();
        $abonoModel = new AbonoModel();

        $data['prestamo'] = $prestamoModel
            ->select('prestamo.*, empleado.emp_nombre')
            ->join('empleado', 'empleado.id_empleado = prestamo.id_empleado')
            ->find($id_prestamo);

        $data['abonos'] = $abonoModel->where('id_prestamo', $id_prestamo)->find();

        $totalAbonoCapital = $abonoModel
            ->selectSum('monto_capital')
            ->where('id_prestamo', $id_prestamo)
            ->first();

        $resto = $data['prestamo']->monto - $totalAbonoCapital->monto_capital;

        $pagoFijo = $data['prestamo']->monto / $data['prestamo']->duracion;

        $interes = $resto * 0.1;

        $totalPago = $pagoFijo + $interes;

        $data['resto'] = number_format($resto, 2);
        $data['pagoFijo'] = number_format($pagoFijo, 2);
        $data['interes'] = number_format($interes, 2);
        $data['totalPago'] = number_format($totalPago, 2);

        return view('abono/index', $data);
    }

    public function registrar($id_prestamo)
    {
        $prestamoModel = new PrestamoModel();
        $abonoModel = new AbonoModel();

        $data['prestamo'] = $prestamoModel
            ->select('prestamo.*, empleado.emp_nombre')
            ->join('empleado', 'empleado.id_empleado = prestamo.id_empleado')
            ->find($id_prestamo);

        $data['abonos'] = $abonoModel->where('id_prestamo', $id_prestamo)->find();

        $totalAbonoCapital = $abonoModel
            ->selectSum('monto_capital')
            ->where('id_prestamo', $id_prestamo)
            ->first();

        $resto = $data['prestamo']->monto - $totalAbonoCapital->monto_capital;

        $pagoFijo = $data['prestamo']->monto / $data['prestamo']->duracion;

        $interes = $resto * 0.1;

        $totalPago = $pagoFijo + $interes;

        $abonoModel->insert([
            'abn_fecha' => date('Y-m-d'),
            'monto_capital' => $pagoFijo,
            'monto_interes' => $interes,
            'montototal' => $totalPago,
            'id_prestamo' => $id_prestamo
        ]);
        session()->setFlashdata('success', '¡El pago fue aplicado con éxito!');
        return redirect()->to(base_url('prestamos/detalles/' . $id_prestamo));
    }
}
