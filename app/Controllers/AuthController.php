<?php

namespace App\Controllers;

use App\Models\EmpleadoModel;
use App\Models\PuestoModel;

class AuthController extends BaseController
{
    // función para iniciar sesión
    public function login()
    {
        // Recibir datos del formulario
        $usuario = $this->request->getPost('usuario');
        $contrasena = $this->request->getPost('contrasena');

        // Crear una instancia de la clase modelo Empleado
        $empleadoModel = new EmpleadoModel();

        // Buscar empleado por usuario en la bd
        $empleado = $empleadoModel->where('usuario', $usuario)->first();

        // Crear una instancia de session
        $session = session();

        // Retornar mensaje de error si el usuario no existe
        if (is_null($empleado)) :
            $session->setFlashdata('error', 'No existe un usuario con ese nombre, intenta de nuevo.');
            return redirect()->to(base_url('/'));
        endif;

        // Retornar mensaje de error si la contraseña es incorrecta
        if ($empleado->contrasena != $contrasena) :
            $session->setFlashdata('error', 'La contraseña es incorrecta, intenta de nuevo.');
            return redirect()->to(base_url('/'));
        endif;

        // Si el usuario y la contraseña son correctos
        // se crea una sesión con la info del usuario
        $session->empleado = $empleado;

        if ($empleado) :
            $puestoModel = new PuestoModel(); // * si se encontró un empleado, obtenemos su puesto actual
            $puesto = $puestoModel
                ->join('det_emp_puesto', 'puesto.id_puesto = det_emp_puesto.id_puesto')
                ->where(
                    'det_emp_puesto.id_empleado',
                    $empleado->id_empleado
                )
                ->where('det_emp_puesto.fecha_fin is null')
                ->first();
            $empleado->puesto = $puesto->pst_nombre;
        endif;
        
        // redirigimos a la vista de administración
        return redirect()->to(base_url('/admin'));
    }

    // Aquí va a ir la función para cerra sesión
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}
