<?= $this->extend('plantilla') ?>
<?= $this->section('contenido') ?>
<div class="container">
    <div class="row">
        <h3>Información del préstamo</h3>
        <table class="table">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Empleado</td>
                    <td>Monto original</td>
                    <td>Plazo</td>
                    <td>Pago fijo</td>
                    <td>Saldo Actual</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $prestamo->id_prestamo; ?></td>
                    <td><?= $prestamo->emp_nombre; ?></td>
                    <td><?= number_format($prestamo->monto, 2); ?></td>
                    <td><?= $prestamo->duracion; ?></td>
                    <td><?= $pagoFijo; ?></td>
                    <td><?= $resto; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row mt-5">
        <h3>Información el pago</h3>
        <table class="table ">
            <tbody>
                <tr>
                    <td>Id Préstamo: <?= $prestamo->id_prestamo; ?></td>
                    <td>Fecha: <?= date('Y-m-d'); ?></td>
                </tr>
                <tr>
                    <td>Capital</td>
                    <td>$<?= $pagoFijo; ?></td>
                </tr>
                <tr>
                    <td>Interés</td>
                    <td>$<?= $interes; ?></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>$<?= $totalPago; ?></td>
                </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            <a href="<?= base_url('abono/registrar/' . $prestamo->id_prestamo); ?>" class="btn btn-primary btn-sm">Abonar</a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>