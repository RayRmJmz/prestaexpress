<?php echo $this->extend('plantilla'); ?>

<?php echo $this->section('contenido'); ?>
<div class="container mt-3">
    <div class="row justify-content-between align-items-center">
        <h3 class="col-auto">Intereses cobrados en el año</h3>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <td>#</td>
                <td>Periodo</td>
                <td>Abonos recibidos</td>
                <td>Monto total</td>
                <td>Intereses cobrados</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($interesesCobrados as $i => $datos) : ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $datos->periodo; ?></td>
                    <td><?= $datos->abonos ?></td>
                    <td><?= $datos->total; ?></td>
                    <td><?= $datos->intereses ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $pager->links(); ?>
</div>
</div>
<?php echo $this->endSection(); ?>