<?php echo $this->extend('plantilla'); ?>

<?php echo $this->section('contenido'); ?>
<div class="container mt-3">
    <div class="row justify-content-between align-items-center">
        <h3 class="col-auto">Prestamos activos</h3>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <td>#</td>
                <td>Nombre del empleado</td>
                <td>Prestamos solicitados</td>
                <td>Aprobados</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($prestamosPorEmpleado as $i => $prestamo) : ?>
                <tr>
                    <td><?= $i + 1; ?></td>
                    <td><?= $prestamo->emp_nombre; ?></td>
                    <td><?= $prestamo->prestamos; ?></td>
                    <td><?= $prestamo->aprobados; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $pager->links(); ?>
</div>
</div>
<?php echo $this->endSection(); ?>