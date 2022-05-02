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
                <td>Periodo</td>
                <td>Abonos</td>
                <td>Monto Préstamo</td>
                <td>Monto resto</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($prestamosActivos as $i => $prestamo) : ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $prestamo->nombreEmpleado; ?></td>
                    <td><?= $prestamo->fecha_ini_desc . ' - ' . $prestamo->fecha_fin_desc; ?></td>
                    <td><?= $prestamo->abonos . ' de ' . $prestamo->duracion ?></td>
                    <td><?= $prestamo->monto ?></td>
                    <td><?= $prestamo->resto ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $pager->links(); ?>
</div>
</div>
<?php echo $this->endSection(); ?>