<?php

namespace App\Controllers;

use App\Models\PrestamoModel;
use  App\Models\AbonoModel;

class Home extends BaseController
{

    // * muestra vista de formulario de login
    public function index()
    {
        return view('auth/login');
    }

    //funcion para cargar vistas
    public function view($page = 'inicio')
    {
        //Este if checha si la vista existe, si no muesta un mensaje de error,
        // podemos diseñar una vista para que muestre el error, en lugar del error que muestra codeigniter
        if (!is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        echo view('pages/head'); //carga el head de neustro HTML, aqui estan todos los links para CSS y scripts de JS 
        echo view('pages/navbar'); // carga el munu de navegacion de nuestra app
        echo view('pages/' . $page); // carga el contenido que tenemos en nuestra app
        echo view('pages/footer'); // carga el pie de pagina de la app
    }

    public function admin()
    {
        return view('admin');
    }

    // * FUNCIONES DE REPORTES
    public function reportes()
    {
        return view('reportes');
    }

    public function prestamosPorEmpleado()
    {
        $prestamoModel = new PrestamoModel();
        $data['prestamosPorEmpleado'] = $prestamoModel
            ->select('empleado.emp_nombre,
                COUNT(prestamo.id_empleado) as prestamos,
                COUNT(prestamo.estado = "APROBADO" or null) as aprobados')
            ->join('empleado',  'empleado.id_empleado = prestamo.id_empleado')
            ->groupBy('prestamo.id_empleado')
            ->orderBy('prestamos', 'desc')
            ->paginate(25);
        $data['pager'] = $prestamoModel->pager;
        return view('reportePrestamosPorEmpleado', $data);
    }

    public function interesesCobrados()
    {
        $abonoModel = new AbonoModel();
        $data['interesesCobrados'] = $abonoModel
            ->select('abono.id_abono,
                DATE_FORMAT(abono.abn_fecha, "%Y-%m") as periodo,
                COUNT(DATE_FORMAT(abono.abn_fecha, "%Y-%m")),
                ROUND(SUM(monto_interes), 2) as  interesesCobrados,
                ROUND(SUM(montototal), 2) as total')
            ->groupBy('periodo')
            ->orderBy('abn_fecha', 'desc')
            ->paginate(25);
        $data['pager']  = $abonoModel->pager;
        return view('reporteInteresCobrados', $data);
    }
}
