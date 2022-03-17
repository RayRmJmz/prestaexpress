<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Primero van los LINK A  CSS -->
    <!-- Bootstrap CSS -->
    <link href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- Fontawesome CSS -->
    <link href="<?= base_url('fontawesome-6/css/all.min.css') ?>" rel="stylesheet">

    <!-- Despues van los SCRIPTS de JS -->
    <!-- JS puede ir en el head o antes de terminar la etiqueta de <body> -->
    <!-- Bootstrap Bundle with Popper -->
    <script src="<?= base_url('bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- JQuery para librerias AJAX -->
    <script src="<?= base_url('jquery-3.6.0.min.js') ?>"></script>
    <!-- Toastr - para poner avisos en lugar de alerts -->
    <script src="<?= base_url('toastr/toastr.min.js') ?>"></script>
    <!-- JS donde esta la base_URL -->
    <script src="<?= base_url('js/baseURL.js') ?>"></script>
    <title>Hello, world!</title>

    <style>
        body {
            min-height: auto;
            /*la longitud de la pagina se adapta al contenido de la misma*/
            padding-top: 4.5rem;
            /* da un margen al top   */
        }
    </style>
</head>