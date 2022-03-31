<?= $this->extend('plantilla') ?>
<?= $this->section('contenido') ?>
<div class="container mt-3">
    <div class="row justify-content-between align-items-center">
        <h3 class="col-auto">Solicitud de préstamo</h3>
        <div class="col-auto">
            <button form="formulario" class="btn btn-primary btn-sm" title="Registrar solicitud">
                Solicitar
            </button>
        </div>
    </div>
    <div class="row">
        <p>Fecha: <?php echo date('Y-m-d'); ?></p>
        <p>Empleado: <?php echo session('empleado')->emp_nombre; ?> </p>
        <p>Pago base: $<span id="pagoBase"></span></p>
    </div>
    <form action="<?php echo base_url('prestamos/registrar'); ?>" method="post" class="row g-3" id="formulario">
        <div class="col-md-6">
            <label for="monto" class="form-label">Monto</label>
            <input class="form-control" type="number" name="monto" id="monto" min="<?php echo $montoMin; ?>" max="<?php echo $montoMax; ?>" value="<?php echo $montoMin; ?>" required>
        </div>
        <div class="col-md-6">
            <label for="duracion" class="form-label">Duración - Quincenas a pagar (6-48)</label>
            <input class="form-control" type="number" name="duracion" id="duracion" min="6" max="48" value="6" required>
        </div>
    </form>
</div>
<?= $this->endSection() ?>