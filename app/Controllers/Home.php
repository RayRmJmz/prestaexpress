<?php

namespace App\Controllers;

class Home extends BaseController
{

    // * muestra vista de formulario de login
    public function index()
    {
        return view('auth/login');
    }

    public function inicio(){
        echo "Hola mundo";
        echo "23 de febrero 2022";
    }


}
