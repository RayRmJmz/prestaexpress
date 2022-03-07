<?php

namespace App\Controllers;

use App\Models\EmpleadoModel;

class AuthController extends BaseController
{
    public function login()
    {
        // Obtener datos del formulario
        $usuario = $this->request->getPost('usuario');
        $contrasena = $this->request->getPost('contrasena');

        // Crear una instancia de Empleado
        $empleadoModel = new EmpleadoModel();

        // Buscar empleado por usuario en la bd
        $empleado = $empleadoModel->obtenerEmpleado($usuario);

        // Crear una instancia de session
        $session = session();

        // Retornar mensaje de error si el usuario no existe
        if (is_null($empleado)) :
            $session->setFlashdata('error', 'No se encontró un usuario con ese nombre, por favor inténtalo de nuevo.');
            return redirect()->to(base_url('/'));
        endif;

        // Si el usuario si existe, comprobamos la contraseña
        if ($contrasena != $empleado->contrasena) :
            $session->setFlashdata('error', 'Usuario o contraseña incorrecto, por favor inténtalo de nuevo.');
            return redirect()->to(base_url('/'));
        endif;

        // Si el usuario y la contraseña son correcos
        // se crea una sesión con la info del usuario
        $session->empleado = $empleado;

        // redirigimos a la vista de administración
        return redirect()->to(base_url('/admin'));
    }

    public function logout()
    {
        // Crear una instancia de session
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/'));
    }
}
