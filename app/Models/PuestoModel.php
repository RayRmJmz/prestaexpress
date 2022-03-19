<?php

namespace App\Models;

use CodeIgniter\Model;

class PuestoModel extends Model
{
    protected $table            = 'puesto'; // nombre tabla en la bd
    protected $primaryKey       = 'id_puesto'; // nombre llave primaria de la tabla
    protected $useAutoIncrement = true; // si la llave primaria es auto incrementable
    protected $returnType       = 'object'; // (opcional, por defecto usa array) tipo de datos que retornara el modelo
    protected $allowedFields    =
    [
        'pst_nombre',
        'pst_sueldo',
    ]; // (obligatorio) campos de tabla que ingresaremos mediante el formulario
}
