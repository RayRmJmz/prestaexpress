<?= $this->extend('plantilla') ?>
<?= $this->section('contenido') ?>
<div class="container mt-3">
    <div class="row justify-content-between align-items-center">
        <h3 class="col-auto">Editar Empleado</h3>
        <div class="col-auto">
            <button form="formularioEmpleado" class="btn btn-primary btn-sm" title="Registrar empleado">
                Actualizar
            </button>
        </div>
    </div>
    <form action="<?php echo base_url('empleados/actualizar/' . $empleado->id_empleado); ?>" method="post" class="row g-3" id="formularioEmpleado">
        <div class="col-md-6">
            <label for="emp_nombre" class="form-label">Nombre</label>
            <input required type="text" size="5" class="form-control" value="<?= $empleado->emp_nombre ?>" name="emp_nombre" id="emp_nombre">
        </div>
        <div class="col-md-6">
            <label for="usuario" class="form-label">Usuario</label>
            <input required type="text" class="form-control" value="<?= $empleado->usuario ?>" name=" usuario" id=" usuario">
        </div>
        <div class="col-md-6">
            <label for="contrasena" class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="contrasena" id="contrasena" placeholder="Dejar en blanco para mantener la misma">
        </div>
        <div class="col-md-6">
            <label for="puesto" class="form-label">Puesto</label>
            <select required class="form-select" aria-label="Selección de puesto de empleado" name="puesto" id="puesto">
                <option disabled selected value="">Seleccionar</option>
                <?php foreach ($puestos as $puesto) : ?>
                    <option value="<?php echo $puesto->id_puesto; ?>" <?php echo ($puestoActual and $puestoActual->id_puesto == $puesto->id_puesto) ? 'selected' : ''; ?>><?php echo $puesto->pst_nombre; ?></option>
                <?php endforeach; ?>

            </select>
        </div>
        <div class="col-md-12">
            <label class="form-check-label" for="estado">Estado</label>
            <div class="col-md-6">
                <label for="estado" class="form-label">Estado</label>
                <div class="form-check-inline">
                    <input class="form-check-input" type="radio" value="1" name="estado" id="activo" <?php echo $empleado->estado == 1 ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="activo">
                        Activo
                    </label>
                </div>
                <div class="form-check-inline">
                    <input class="form-check-input" type="radio" value="0" name="estado" id="inactivo" <?php echo $empleado->estado == 0 ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="inactivo">
                        Inactivo
                    </label>
                </div>
            </div>
        </div>
    </form>
    <h4>Puestos</h4>
    <table class="table table-bordered table-striped table-responsive table-hover">
        <?php foreach ($puestosEmpleado as $puesto) : ?>
            <tr>
                <td><?php echo $puesto->pst_nombre; ?></td>
                <td><?php echo $puesto->fecha_inicio; ?></td>
                <td><?php echo $puesto->fecha_fin ?? '-'; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
</div>
<?= $this->endSection() ?>