<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function inicio(){
        echo "Hola mundo";
        echo "23 de febrero 2022";
    }

    public function admin()
    {
        return view('admin/index');
    }
}
