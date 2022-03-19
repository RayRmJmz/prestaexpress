<?php

namespace App\Models;

use CodeIgniter\Model;

class DetEmpPuestoModel extends Model
{
    protected $table            = 'det_emp_puesto';
    protected $primaryKey       = 'id_det_emp_puesto';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $allowedFields    =
    [
        'id_empleado',
        'id_puesto',
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'fecha_inicio';
    protected $updatedField  = false;
    protected $deletedField  = 'fecha_fin';
}