<body>
    <!-- Inicio Navbar -->
    <nav class="navbar navbar-light bg-light navbar-expand-lg fixed-top" aria-label="Eighth navbar example">
        <div class="container">
            <!-- BRAND -- nombre de la app  -->
            <a class="navbar-brand" href="#">APP NAME </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">

                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="#">Inicio</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="#">Menu 1</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu 2
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Opcion 1</a></li>
                            <li><a class="dropdown-item" href="#">Opcion 2</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu 3
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Opcion 1</a></li>
                            <li><a class="dropdown-item" href="#">Opcion 2</a></li>
                            <li><a class="dropdown-item" href="#">Opcion 3</a></li>


                        </ul>
                    </li>

                </ul>
                <ul class="nav navbar-nav">
                    <li class="nav-item">
                        <p class="dropdown-item">USUARIO NAME</p>
                    </li>
                    <li class="nav-item">
                        <!-- Muestra un icono de Fontawesome con la etiqueta <i></i> -->
                        <i aria-current="page" class="nav-link fa-solid fa-arrow-right-from-bracket" title="Cerrar sesión" onclick="close_session();"></i>
                    </li>

                </ul>
                <script>
                    function close_session() {
                        const req = new XMLHttpRequest();
                        req.onload = function() {
                            let json = JSON.parse(this.responseText);
                            switch (json['validation']) {
                                case true:
                                    Command: toastr["success"]("Serás redirigido al inicio", "Sesión cerrada");
                                    setTimeout(function() {
                                        window.location.assign(globalURL);
                                    }, 1000);
                                    break;
                                default:
                                    Command: toastr["error"]("Ha ocurrido un error del parte del servidor", "Error del servidor");
                                    document.querySelector("#form").style.display = 'contents';
                                    break;
                            }
                        }
                        req.open('POST', globalURL + 'CONTROLLER/FUNCTION');
                        req.send(JSON.stringify());
                    }
                </script>


            </div>
        </div>
    </nav>
    <!-- Fin Navbar -->