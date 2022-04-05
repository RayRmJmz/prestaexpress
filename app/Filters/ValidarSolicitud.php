<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

use App\Models\PrestamoModel;

class ValidarSolicitud implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Comprobar antiguedadd
        $fechaActual = new \DateTime(date('Y-m-d'));
        $fechaIngreso = new \DateTime(session('empleado')->fecha_ingreso);
        $aniosTrabajados = $fechaActual->diff($fechaIngreso)->y;
        $data = [];
        if ($aniosTrabajados < 1) {
            array_push($data, 'Tienes menos de un año de antiguuedad');
        }
        $prestamoModel = new PrestamoModel();
        $prestamoActivo = $prestamoModel->where('id_empleado', session('empleado')->id_empleado)
            ->where('fecha_fin_desc is null')
            ->find();
        if ($prestamoActivo) {
            array_push($data, 'Tiene un préstamo activo');
        }
        if ($data) {
            session()->setFlashdata('motivos', $data);
        }
        
        
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
