<?php echo $this->extend('plantilla.php'); ?>
<?php echo $this->section('contenido'); ?>
<div class="container mt-3">
    <div class="row justify-content-between align-items-center">
        <h3 class="col-auto">Empleados</h3>
        <div class="col-auto">
            <a href="<?php echo base_url('empleados/crear'); ?>" class="btn btn-primary btn-sm" title="Nuevo empleado">
                <i class="bi bi-plus-circle"></i>
                Nuevo
            </a>
        </div>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Fecha de ingreso</th>
                <th>Puesto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($empleados) and !is_null($empleados)) : ?>
                <?php foreach ($empleados as $k => $empleado) : ?>
                    <tr>
                        <td class="font-weight-bold"><?= $k + 1; ?></td>
                        <td>
                            <p class="mb-0"><?= $empleado->emp_nombre; ?></p>
                            <p class="font-italic text-muted small mb-0"><?= $empleado->usuario; ?></p>
                        </td>
                        <td><?= $empleado->fecha_ingreso; ?></td>
                        <td><?= $empleado->pst_nombre; ?></td>
                        <td>
                            <a href="<?php echo base_url('empleados/editar/' . $empleado->id_empleado); ?>" class="btn btn-outline-primary btn-sm">Editar</a>
                            <a href="<?php echo base_url('empleados/eliminar/' . $empleado->id_empleado); ?>" class="btn btn-outline-danger btn-sm">Dar de baja</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4">
                        <p>La tabla no tiene registros.</p>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php echo $pager->links() ?>
</div>
</div>

<?php echo $this->endSection(); ?>