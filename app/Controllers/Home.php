<?php

namespace App\Controllers;

use App\Models\MiModelo;

class Home extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }
}
