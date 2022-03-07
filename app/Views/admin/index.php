<!DOCTYPE html>
<html lang="es-Mx">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRESTAEXPRESS</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- feather icons -->
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>
    <header>
        <div class="container pt-5 pb-3">
            <div class="row justify-content-between">
                <div class="col-auto">
                    <h1><i class="fa-solid fa-gauge-high" aria-hidden="true"></i> Dashboard</h1>
                </div>
                <div class="col-auto">
                    <a href="<?php echo base_url('auth/logout'); ?>" class="btn btn-outline-dark btn-sm"><i data-feather="log-out"></i></a>
                </div>
            </div>
            <div class="row">
                <p class="col-12 text-muted">

                </p>

            </div>
        </div>

    </header>
    <main>
        <div class="container pb-5">
            <div class="row row-cols-1 row-cols-md-1 g-2">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title ms-1">Solicitud</h5>
                            <p class="card-text text-muted mb-5 ms-1">Solicitar un nuevo prestamo</p>

                            <a href="<?php echo base_url("/admin/solicitud"); ?>" class="btn btn-outline-primary mb-1 mt-1 btn-sm">Entrar</a>
                        </div>
                    </div>
                </div>
                <?php if (in_array('Administrador', session('empleado')->puestos)) : ?>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title ms-1">Reportes</h5>
                                <p class="card-text text-muted mb-5 ms-1">Reportes de los prestamos</p>
                                <a href="<?php echo base_url("/admin/reportes"); ?>" class="btn btn-outline-primary mb-1 mt-1 btn-sm">Entrar</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title ms-1">Préstamos</h5>
                            <p class="card-text text-muted mb-5 ms-1">Lista de préstamos solicitados</p>

                            <a href="<?php echo base_url("/admin/prestamos"); ?>" class="btn btn-outline-primary mb-1 mt-1 btn-sm">Entrar</a>
                        </div>
                    </div>
                </div>
                <?php if (in_array('Administrador', session('empleado')->puestos)) : ?>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title ms-1">Empleados</h5>
                                <p class="card-text text-muted mb-5 ms-1">Empleados registrados</p>

                                <a href="<?php echo base_url("/admin/empleados"); ?>" class="btn btn-outline-primary btn-sm mb-1 mt-1 ">Entrar</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <!-- bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- feather icons -->
    <script>
        feather.replace()
    </script>
</body>

</html>