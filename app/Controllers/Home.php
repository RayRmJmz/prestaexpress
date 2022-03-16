<?php

namespace App\Controllers;

use App\Models\MiModelo;

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
        if (!is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        echo view('pages/head');
        //echo view('pages/sidebar');
        //echo view('pages/' . $page);
        //echo view('pages/footer');
    }

    //CRUD
    // CREATE = INSERT = CREAR UN NUEVO REGISTRO EN BD
    // READ = SELECT = HACER UNA CONSULTA EN LA BD
    // UPDATE = == HACER UNA ACTUALIZACION DE UN REGISTRO EN LA BD
    // DELETE = == BORRAR UN REGISTRO EN LA BD
    function readEmpleados()
    {
        echo "Mostrando todos los empleados";
    }
}
