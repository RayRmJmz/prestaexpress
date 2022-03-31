<?php echo $this->extend('plantilla'); ?>
<?php echo $this->section('contenido'); ?>
<div class="container mt-3">
    <div class="row justify-content-between align-items-center">
        <h3 class="col-auto">Prestamos</h3>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Empleado</th>
                <th>Fecha solicitud - aprobado</th>
                <th>Fecha inicio - fin</th>
                <th>Monto</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Contenido de la tabla -->
            <?php if (isset($prestamos) and !is_null($prestamos)) : ?>

                <?php foreach ($prestamos as $prestamo) : ?>
                    <tr>
                        <td><?= $prestamo->id_prestamo; ?></td>
                        <td><?= $prestamo->emp_nombre; ?></td>
                        <td><?= $prestamo->fechasolicitud . ' - ' . $prestamo->fecha_aprob ?></td>
                        <td><?= $prestamo->fecha_ini_desc . '-' . $prestamo->fecha_fin_desc; ?></td>
                        <td><?= $prestamo->monto; ?></td>
                        <td><?= $prestamo->estado; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td>No hay datos para mostrar</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php echo $pager->links() ?>
</div>
</div>
<?php echo $this->endSection(); ?>