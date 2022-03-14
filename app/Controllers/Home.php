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
}
