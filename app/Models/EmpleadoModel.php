<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpleadoModel extends Model
{
    protected $table            = 'empleado';
    protected $primaryKey       = 'id_empleado';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $allowedFields    =
    [
        'emp_nombre',
        'estado',
        'usuario'
    ];
    protected $useTimestamps = false;
    protected $createdField  = 'fecha_ingreso';
    protected $deletedField  = 'fecha_egreso';

    public function obtenerEmpleado($usuario)
    {
        $empleado = $this->where('usuario', $usuario)
            ->first();
        if ($empleado) $empleado->puestos = $this->obtenerPuestos($empleado->id_empleado);
        return $empleado;
    }

    public function obtenerPuestos($id_empleado)
    {
        $puestos = $this->db->table('det_emp_puesto')
            ->select('puesto.pst_nombre')
            ->where('det_emp_puesto.id_empleado', $id_empleado)
            ->where('det_emp_puesto.fecha_fin', null)
            ->orWhere('det_emp_puesto.fecha_fin >=', date("Y-m-d"))
            ->join('puesto', 'det_emp_puesto.id_puesto = puesto.id_puesto')
            ->get()
            ->getResultArray();
        return array_column($puestos, 'pst_nombre');
    }
}
