<?= $this->extend('plantilla') ?>
<?= $this->section('contenido') ?>
<div class="container mt-3">
    <div class="row justify-content-between align-items-center">
        <h3 class="col-auto">Nuevo Empleado</h3>
        <div class="col-auto">
            <button form="formularioEmpleado" class="btn btn-primary btn-sm" title="Registrar empleado">
                Registrar
            </button>
        </div>
    </div>
    <form action="<?php echo base_url('empleados/registrar'); ?>" method="post" class="row g-3" id="formularioEmpleado">
        <div class="col-md-6">
            <label for="emp_nombre" class="form-label">Nombre</label>
            <input required type="text" size="5" class="form-control" name="emp_nombre" id="emp_nombre">
        </div>
        <div class="col-md-6">
            <label for="usuario" class="form-label">Usuario</label>
            <input required type="text" class="form-control" name=" usuario" id=" usuario">
        </div>
        <div class="col-md-6">
            <label for="contrasena" class="form-label">Contraseña</label>
            <input required type="password" class="form-control" name="contrasena" id="contrasena">
        </div>
        <div class="col-md-6">
            <label for="contrasena" class="form-label">Puesto</label>
            <select required class="form-select" aria-label="Selección de puesto de empleado" name="puesto" id="puesto">
                <option disabled selected value="">Seleccionar</option>
                <?php foreach ($puestos as $puesto) : ?>
                    <option value="<?php echo $puesto->id_puesto; ?>"><?php echo $puesto->pst_nombre; ?></option>
                <?php endforeach; ?>

            </select>
        </div>
        <div class="col-md-12">
            <label class="form-check-label" for="estado">Estado</label>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" name="estado" id="estado" checked>
                <label class="form-check-label" for="estado">Activo/Inactivo</label>
            </div>
        </div>
    </form>
</div>
</div>
<?= $this->endSection() ?>