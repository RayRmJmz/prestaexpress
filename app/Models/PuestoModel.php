<?php

namespace App\Models;

use CodeIgniter\Model;

class PuestoModel extends Model
{
    protected $table = 'puesto'; // nombre de la tabla en la bd
    protected $primaryKey = 'id_puesto'; // nombre de la llave primaria, que se usa en los métodos 
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $allowedFields =
    [
        'pst_nombre',
        'pst_sueldo',
    ];
}