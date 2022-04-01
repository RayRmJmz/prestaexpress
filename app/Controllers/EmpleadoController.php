<?php

namespace App\Controllers;

// importamos los modelos que vamos a consultar
use App\Models\EmpleadoModel;
use App\Models\PuestoModel;
use App\Models\DetEmpPuestoModel;

class EmpleadoController extends BaseController
{
    // vista de indice (tabla) de empleados
    public function index()
    {
        // conseguir todos los empleados vigentes de la bd
        // - creamos una instancia de la tabla de empleados
        $empleadoModel = new EmpleadoModel();

        // Recuperamos los empleados vigentes a traves del modelo
        // Como en el modelo establecimos 'fecha_egreso' como $deletedField
        // CodeIgniter sabe automaticamente que aquellos usuarios con una fecha de egreso registrada
        // son los que no estan vigentes
        // ** Armamos la consulta 
        $data['empleados'] = $empleadoModel
            ->select('empleado.*, puesto.pst_nombre')
            ->join('det_emp_puesto', 'empleado.id_empleado = det_emp_puesto.id_empleado')
            ->join('puesto', 'puesto.id_puesto = det_emp_puesto.id_puesto')
            ->where('det_emp_puesto.fecha_fin is', null)
            ->orderBy('det_emp_puesto.id_det_emp_puesto', 'desc')
            ->groupBy('empleado.id_empleado')
            ->paginate(7);
        // print_r($data['empleados']);
        // return;
        // si usamos la libreria paginate, debemos generar los links
        $data['pager'] = $empleadoModel->pager;
        // enviamos esta informacion a la vista
        // debemos crear una carpeta llama empleado dentro de app/Views
        // y dentro un archivo php llamado index.php
        return view('empleado/index', $data);
    }

    // vista de formulario para crear un nuevo empleado
    public function crear()
    {
        $puestosModel = new PuestoModel(); // instancia de modelo puestos
        $data['puestos'] = $puestosModel->findAll(); // obtenemos los puestos disponibles para mostrarlos en el formulario
        return view('empleado/crear', $data); // retornamos la vista y junto con la variable data
    }

    // registrar un nuevo empleado
    public function registrar()
    {
        // instancia de los modelos que usaremos
        $empleadoModel = new EmpleadoModel(); // modelo empleado para registrar el nuevo empleado
        $detEmpPuestoModel = new DetEmpPuestoModel(); // modelo DetEmpPuesto para registrar el puesto seleccionado por el usuario (que estamos recibiendo por post desde el formulario) del nuevo empleado en la tabla detalle

        // creamos un array de los datos recibidos desde el formulario
        // con el formato 'nombreCampoBD' => $this->request->getPost('nombreDelCampoEnElFormulario')
        $data = [
            'emp_nombre' => $this->request->getPost('emp_nombre'),
            'usuario' => $this->request->getPost('usuario'),
            'estado'  => $this->request->getPost('estado'),
            'contrasena' => $this->request->getPost('contrasena')
        ];

        $empleado = $empleadoModel->insert($data); // insertamos el nuevo registro en la bd

        // una vez creado el nuevo empleado insertamos el puesto en la tabla detalle
        $detEmpPuestoModel->insert([
            'id_empleado' => $empleado,
            'id_puesto' => $this->request->getPost('puesto')
        ]);

        session()->setFlashdata('success', 'El usuario fue registrado.'); // creamos un mensaje temporal para que el usuario sepa que no ocurrió ningún error

        return redirect()->to(base_url('empleados')); // retornamos a la url principal de empleados
    }

    // vista de formulario para editar un empleado
    public function editar($id_empleado)
    {
        $empleadoModel = new EmpleadoModel(); // instancia del modelo empleado para buscar al empleado por $id_empleado que recibimos como parámetro por la url
        $puestosModel = new PuestoModel(); // instancia del modelo puestos para enviarlos a la vista del formulario y que el usuario pueda seleccionar uno
        $detEmpPuestoModel = new DetEmpPuestoModel(); // instancia del modelo DetEmpPuesto para buscar el puesto actual del empleado a editar, y para mostrar el historial de puestos del empleado

        $data['empleado'] = $empleadoModel->find($id_empleado); // información del empleado a modificar
        $data['puestos'] = $puestosModel->findAll(); // lista de puestos disponibles
        $data['puestoActual'] = $detEmpPuestoModel->where('id_empleado', $id_empleado)->first();

        if (!$data['empleado']) :
            session()->setFlashdata('error', 'Ese usuario no existe.');
            return redirect()->to(base_url('/empleados'));
        endif;

        $data['puestosEmpleado'] = $detEmpPuestoModel
            ->select('puesto.pst_nombre, det_emp_puesto.*') // obtener el nombre del puesto y la información de la tabla detalle 
            ->join('puesto', 'puesto.id_puesto = det_emp_puesto.id_puesto') // inner join de tabla puesto con det_emp_puesto
            ->where('id_empleado', $id_empleado)
            ->orderBy('id_det_emp_puesto', 'desc')
            ->withDeleted() // por que queremos obtener incluso los puestos que no son actuales
            ->find(); // lista de puestos que ha tenido el empleado, como se necesita hacer 
        return view('empleado/editar', $data);
    }

    // actualizar los datos de un registro
    public function actualizar($id_empleado)
    {
        $empleadoModel = new EmpleadoModel(); // modelo para actualizar empleado
        $detEmpPuestoModel = new DetEmpPuestoModel(); // modelo para actualizar el detalle empleado puesto

        $data = [
            'emp_nombre' => $this->request->getPost('emp_nombre'),
            'usuario' => $this->request->getPost('usuario'),
            'estado'  => $this->request->getPost('estado')
        ]; // información recibida del formulario

        // Solo actualizar la contraseña si el usuario ingreso una nueva en  el formulario
        if ($this->request->getPost('contrasena')) :
            $data = [
                'contrasena' => password_hash($this->request->getPost('contrasena'), PASSWORD_BCRYPT)
            ]; // agregamos la nueva contraseña al array de campos que se van a actualizar
        endif;

        $empleadoModel->update($id_empleado, $data); // actualizamos el empleado con la info del formulario

        // si el puesto del empleado cambio, actualizamos la tabla de detalle
        $puestoActual = $detEmpPuestoModel->where('id_empleado', $id_empleado)->orderBy('id_det_emp_puesto', 'desc')->first(); // buscamos el puesto actual registrado del empleado
        if (!$puestoActual) $detEmpPuestoModel->insert([
            'id_empleado' => $id_empleado,
            'id_puesto' => $this->request->getPost('puesto')
        ]);
        if (
            $puestoActual and $puestoActual->id_puesto != $this->request->getPost('puesto')
        ) : // revisamos si el puesto recibido del formulario es diferente para actualizarlo
            // removemos el puesto actual
            $detEmpPuestoModel->delete($puestoActual->id_det_emp_puesto);
            // ingresamos el nuevo puesto
            $detEmpPuestoModel->insert([
                'id_empleado' => $id_empleado,
                'id_puesto' => $this->request->getPost('puesto')
            ]);
        endif;

        session()->setFlashdata('success', 'El usuario fue actualizado.');
        return redirect()->back();
    }

    // eliminar un registro por id
    public function eliminar($id_empleado)
    {
        $empleadoModel = new EmpleadoModel(); // modelo empleado para eliminarlo de la bd
        $empleadoModel->delete($id_empleado); // eliminamos al empleado con su id
        session()->setFlashdata('success', 'El usuario fue eliminado.'); // mandamos un mensaje de éxito a la vista
        return redirect()->to(base_url('/empleados')); // redirigimos a la vista principal de empleados
    }
}
