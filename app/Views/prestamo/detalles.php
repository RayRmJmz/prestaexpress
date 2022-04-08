<?= $this->extend('plantilla') ?>
<?= $this->section('contenido') ?>
<div class="container">
    <div class="row">
        <p>Folio: <?= $prestamo->id_prestamo ?></p>
        <p>Estado: <?= $prestamo->estado ?></p>
        <p>Empleado: <?= $prestamo->emp_nombre ?></p>
        <p>Monto Prestado: <?= number_format($prestamo->monto, 2) ?></p>
        <p>Resto: <?= $resto; ?></p>
    </div>
    <div class="row">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Fecha</td>
                    <td>Abono</td>
                    <td>A capital</td>
                    <td>Interés</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($abonos as $abono) : ?>
                    <tr>
                        <td><?= $abono->id_abono; ?></td>
                        <td><?= $abono->abn_fecha; ?></td>
                        <td><?= number_format($abono->montototal, 2); ?></td>
                        <td><?= number_format($abono->monto_capital, 2); ?></td>
                        <td><?= number_format($abono->monto_interes, 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>