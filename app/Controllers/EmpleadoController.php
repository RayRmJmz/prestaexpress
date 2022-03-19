<?php

namespace App\Controllers;

// importamos los modelos que vamos a consultar
use App\Models\EmpleadoModel;
use App\Models\PuestoModel;
use App\Models\DetEmpPuestoModel;

class EmpleadoController extends BaseController
{
    // AQUI VA EL CóDIGO DE LAS FUNCIONES DEL CONTROLADOR
    
    // retornar el indice de empleados
    public function index()
    {
        // instancia del modelo empleado
        $empleadoModel = new EmpleadoModel();

        // recuperar todos los empleados de la bd
        $data['empleados'] = $empleadoModel->paginate(25);
        $data['pager'] = $empleadoModel->pager;
        
        return view('empleado/index', $data);
    }

    // retornar vista del formulario
    public function crear()
    {
        $puestoModel = new PuestoModel();
        $data['puestos'] = $puestoModel->findAll();
        return view('empleado/crear', $data);
    }

    public function registrar()
    {
        $empleadoModel = new EmpleadoModel();
        $detEmpPuestoModel = new DetEmpPuestoModel();

        $data = [
            'emp_nombre' => $this->request->getPost('emp_nombre'),
            'usuario' => $this->request->getPost('usuario'),
            'estado' => $this->request->getPost('estado'),
            'contrasena' => $this->request->getPost('contrasena'),
        ];

        $id_empleado = $empleadoModel->insert($data);

        $detEmpPuestoModel->insert([
            'id_empleado' => $id_empleado,
            'id_puesto' => $this->request->getPost('puesto')
        ]);

        session()->setFlashdata('success', 'El usuario fue creado.');

        return redirect()->to(base_url('empleados'));
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

    if (!$data['empleado']) : // si el usuario no existe o no esta activo...
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
            'contrasena' => $this->request->getPost('contrasena'),
        ]; // agregamos la nueva contraseña al array de campos que se van a actualizar
    endif;

    $empleadoModel->update($id_empleado, $data); // actualizamos el empleado con la info del formulario

    // si el puesto del empleado cambio, actualizamos la tabla de detalle
    $puestoActual = $detEmpPuestoModel->where('id_empleado', $id_empleado)->first(); // buscamos el puesto actual registrado del empleado
    if (!$puestoActual) $detEmpPuestoModel->insert([
            'id_empleado' => $id_empleado,
            'id_puesto' => $this->request->getPost('puesto')
    ]);
    if ($puestoActual and $puestoActual->id_puesto != $this->request->getPost('puesto')) : // revisamos si el puesto recibido del formulario es diferente para actualizarlo
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