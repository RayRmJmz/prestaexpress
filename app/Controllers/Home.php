<?php

namespace App\Controllers;

// modelos usados para generar los reportes
use App\Models\PrestamoModel;
use App\Models\AbonoModel;

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

    /** 
     * REPORTES
     */

    // Prestamos activos
    public function prestamosActivos()
    {
        $prestamoModel = new PrestamoModel();
        $data['prestamosActivos'] = $prestamoModel
            ->select('prestamo.*, 
                ROUND(SUM(abono.monto_capital), 2) as resto,
                empleado.emp_nombre as nombreEmpleado,
                COUNT(abono.id_prestamo) as abonos')
            ->join('abono', 'prestamo.id_prestamo = abono.id_prestamo')
            ->join('empleado', 'empleado.id_empleado = prestamo.id_empleado')
            ->groupBy('prestamo.id_prestamo')
            ->having('resto >', 0)
            ->paginate(25);
        $data['pager'] = $prestamoModel->pager;
        return view('reportePrestamosActivos', $data);
    }
    // Intereses cobrados
    public function interesesCobrados()
    {
        $abonoModel = new AbonoModel();
        $data['interesesCobrados'] = $abonoModel
            ->select("id_abono, 
                DATE_FORMAT(abono.abn_fecha, '%Y-%m') as periodo, 
                COUNT(DATE_FORMAT(abono.abn_fecha, '%Y-%m')) as abonos, 
                ROUND(SUM(monto_interes), 2) as intereses,
                ROUND(SUM(montototal)) as total")
            ->groupBy("DATE_FORMAT(abono.abn_fecha, '%Y%m')")
            ->orderBy('abn_fecha', 'desc')
            ->paginate(25);
        $data['pager'] = $abonoModel->pager;
        return view('reporteInteresesCobrados', $data);
    }
}
