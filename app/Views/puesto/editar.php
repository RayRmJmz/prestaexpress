<?= $this->extend('plantilla') ?>
<?= $this->section('contenido') ?>
<div class="container mt-3">
    <div class="row justify-content-between align-items-center">
        <h3 class="col-auto">Editar Puesto</h3>
        <div class="col-auto">
            <button form="formularioEmpleado" class="btn btn-primary btn-sm" title="Registrar empleado">
                Actualizar
            </button>
        </div>
    </div>
    <form action="<?php echo base_url('puestos/actualizar/' . $puesto->id_puesto); ?>" method="post" class="row g-3" id="formularioEmpleado">
        <div class="col-md-6">
            <label for="pst_nombre" class="form-label">Nombre</label>
            <input required type="text" size="5" class="form-control" value="<?= $puesto->pst_nombre; ?>" name="pst_nombre" id="pst_nombre">
        </div>
        <div class="col-md-6">
            <label for="pst_sueldo" class="form-label">Sueldo</label>
            <input required type="text" class="form-control" value="<?= $puesto->pst_sueldo; ?>" name="pst_sueldo" id=" pst_sueldo">
        </div>
    </form>
</div>
<?= $this->endSection() ?>