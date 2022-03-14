<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpleadoModel extends Model
{
    // * configuración del modelo
    // la tabla principal sobre la que trabaja el modelo
    protected $table = 'empleado';

    // columna que identifica de manera unica a un registro en la tabla (usado p.e. para buscar registros)
    protected $primaryKey = 'id_empleado';
    
    // indica si la tabla usa la opción auto-incrementable, si es false entonces se debe especificar el valor manualmente
    protected $useAutoIncrement = true;

    // tipo de respeusta por defecto (object, array)
    protected $returnType = 'object';

    // eliminado lógico: si es true, método delete() no eliminara permanentemente el registro de la bd
    // en su lugar establecera la fecha actual en la columna $deletedField, al buscar un registro unicamente
    // mostrara los registros con $deletedField nulo, salvo que especifiquemos lo contrario
    protected $useSoftDeletes = true;

    // indica si la fecha actual sera añadida automaticamente en los 'inserts' y 'updates',
    // si es true, requiere que la tabla contenga columnas 'created_at', 'updated_at'
    protected $useTimestamps = false;

    // especifica el campo  que guarda la fecha en que se inserta un registro a la bd
    protected $createdField = 'fecha_ingreso';

    // especifica el campo  que guarda la fecha en que se actualiza un registro a la bd
    protected $deletedField = 'fecha_egreso';

    /* 
      * Métodos especificos del modelo
     */

    // * Buscar empleado por nombre de usuario
    public function obtenerEmpleado($usuario)
    {
        // burcar el primer registro en el que el nombre de usuario coincida
        $empleado = $this->where('usuario', $usuario)
            ->first();

        return $empleado;
    }
    
}
