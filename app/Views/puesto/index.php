<?php echo $this->extend('plantilla'); ?>

<?php echo $this->section('contenido'); ?>
<div class="container mt-3">
    <div class="row justify-content-between align-items-center">
        <h3 class="col-auto">Puestos</h3>
        <div class="col-auto">
            <a href="<?php echo base_url('puestos/crear'); ?>" class="btn btn-primary btn-sm" title="Nuevo puesto">
                <i class="bi bi-plus-circle"></i>
                Nuevo
            </a>
        </div>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <td>#</td>
                <td>Nombre</td>
                <td>Sueldo</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($puestos as $i => $puesto) : ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $puesto->pst_nombre; ?></td>
                    <td><?= $puesto->pst_sueldo; ?></td>
                    <td>
                        <a href="<?php echo base_url('puestos/editar/' . $puesto->id_puesto); ?>" class="btn btn-outline-primary btn-sm">Editar</a>
                        <a href="<?php echo base_url('puestos/eliminar/' . $puesto->id_puesto); ?>" class="btn btn-outline-danger btn-sm">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $pager->links(); ?>
</div>
</div>
<?php echo $this->endSection(); ?>