<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function inicio(){
        echo "Hola mundo";
        echo "23 de febrero 2022";
    }
}
