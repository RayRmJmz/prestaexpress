<?php echo $this->extend('plantilla'); ?>

<?php echo $this->section('contenido'); ?>
<?= $this->extend('plantilla') ?>
<?= $this->section('contenido') ?>
<!-- DIV para un contenido o header de presentacion -->
<div class=" container mt-5 text-center">
    <h3 class="uppercase">TU APP NAME</h3>
</div>

<!-- DIV para contenido de ka app [tablas, forms, etc.] -->
<div class="container  px-4  gy-5">
    <h4>Bienvenido a TU APP</h4>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus, sunt esse voluptatum similique ullam eveniet magnam illum rem officiis a doloremque vel. Odio facilis esse distinctio, consequuntur nemo doloribus veritatis!</p>
</div>

<div class="container  px-4  gy-5">
    <h4>Esta plantilla contiene una estructura basica para construir tu aplicación </h4>
    <ul>
        <li>Bootstrap 5- cdn</li>
        <li>Fontawesome 6 - cdn</li>
        <li>Cerrar sesión XMLHttpRequest() </li>
    </ul>
</div>
<?= $this->endSection() ?>
<?php echo $this->endSection(); ?>