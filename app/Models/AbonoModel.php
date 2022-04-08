<?php

namespace App\Models;

use CodeIgniter\Model;

class AbonoModel extends Model
{
    protected $table            = 'abono'; // nombre tabla en la bd
    protected $primaryKey       = 'id_abono'; // nombre llave primaria de la tabla, usado en todos los métodos del crud
    protected $useAutoIncrement = true; // si la llave primaria es auto incremental
    protected $returnType       = 'object'; // (opcional, por defecto usa array) tipo de datos que retornara el modelo
    protected $allowedFields    =
    [
        'abn_fecha',
        'id_prestamo',
        'monto_capital',
        'monto_interes',
        'montototal',
    ]; // (obligatorio) campos de tabla que ingresaremos mediante el formulario
}
