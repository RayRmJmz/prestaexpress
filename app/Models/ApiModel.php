<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class ApiModel extends Model
{

    public function getAllEmpleados()
    {
        $db = db_connect(); // * Conectarse ala BD

        $query = $db->query('SELECT * FROM empleado   ORDER BY emp_nombre'); // * Ejecuta la consulta

        $results = $query->getResult(); // * convierte la consulta a un objeto array

        // * se crea un objeto que por default envia un resultado como falso
        $data['response'] = [
            'result' => FALSE,
            'message' => 'No se han encontrado empleados'
        ];

        // * al ejecutar la consulta, nos regresa un array, count() nos regresa el numero de filas, no la consulta encontro nada, el numero de filas es 0, pero si encuentra, entonces el numero de filas es mayor a 1
        if (count($results) > 0) {
            $data['response'] = [
                'result' => TRUE,
                'message' => 'Se han encontrado registros'
            ]; // * cambiamos el mensaje a verdadero
            $columnas = 0;
            foreach ($results as $row) {
                $data['datos'][$columnas] = [
                    'id_empleado' => $row->id_empleado,
                    'nombre' => $row->emp_nombre,
                    'fecha_ingreso' => $row->fecha_ingreso,
                    'fecha_egreso' => $row->fecha_egreso,
                    'estado' => $row->estado,
                    'usuario' => $row->usuario
                ];
                $columnas = $columnas + 1;
            }
        }

        $db->close(); // * Cierra conexion con la BD

        return $data; // * Regresa al modelo el objeto $data[]
    }
}
