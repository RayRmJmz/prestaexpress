<?php

namespace App\Controllers;

use App\Models\EmpleadoModel;

class AuthController extends BaseController
{
    public function login()
    {
        // obtener datos del formulario
        $usuario = $this->request->getPost('usuario');
        $contrasena = $this->request->getPost('contrasena');

        // Instanciar modelo empleado
        $empleadoModel = new EmpleadoModel();

        // instanciar session 
        $session = session();

        $empleado = $empleadoModel->obtenerEmpleado($usuario);

        if (!$empleado) {
            $session->setFlashdata('error', 'Error: Este usuario no existe.');
            return redirect()->to(base_url('/'));
        }

        if (
            $empleado->contrasena != $contrasena
        ) {
            $session->setFlashdata('error', 'Error: Contraseña incorrecta.');
            return redirect()->to(base_url('/'));
        }

        $session->empleado = $empleado;




        return  'Usuario encontrado' . $empleado->emp_nombre;
    }
}
