<!-- Inicio Contenido -->



<!-- DIV para contenido de la app [tablas, forms, etc.] -->
<div class="container  px-4  gy-5">
    <h4>Tabla empleados</h4>
    <?= getenv('app.baseURL'); ?>
    <button class="btn btn-primary">Registrar empleado</button>
    <table class="table table-hover" id="tablaEmpleados" name="tablaEmpleados">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Usuario</th>
                <th scope="col">Fecha ingreso</th>
                <th scope="col">Fecha egreso</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody id="resultEmpleados" name="resultEmpleados">

            <!-- Aqui se cargaran las filas por medio de JS con .innerHTML-->

        </tbody>
    </table>
    <div class=" container text-center" style="display : none;" id="mensajesServer" name="mensajesServer">
    </div>
</div>

<!-- se puede agregar mas contenido para ocultar o mostrar con js -->
<div id="result">
    <button onclick="btnCall(10)">mandar funcion </button>
</div>
<!-- Fin Contenido -->

<script>
    function btnCall($id) {
        console.log("hola");
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            console.log(this.responseText);
            let json = JSON.parse(this.responseText);
            //console.log(Object.keys(json['datos']).length);
            // console.log(json['response']['result']);
        }

        xhttp.open("POST", base_URL + "api/ejemplo");
        xhttp.send();

    }
</script>
<script>
    window.onload = getEmpleados;

    function getEmpleados() {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            //console.log(this.responseText);
            let json = JSON.parse(this.responseText);
            console.log(this.responseText);
            //console.log(Object.keys(json['datos']).length);
            console.log(json['response']['result']);
            switch (json['response']['result']) {
                case true:

                    for (var i = 0; i < Object.keys(json['datos']).length; i++) {
                        /* Con .innerHTML agregamos elemntos e inicia con tr = table row = fila*/
                        document.querySelector('#resultEmpleados').innerHTML += '<tr>' +
                            /* carga los datos a la tabla */
                            '<td>' + json['datos'][i]['nombre'] + '</td>' +
                            '<td>' + json['datos'][i]['usuario'] + '</td>' +
                            '<td>' + json['datos'][i]['fecha_ingreso'] + '</td>' +
                            '<td>' + json['datos'][i]['fecha_egreso'] + '</td>' +
                            '<td>' + json['datos'][i]['estado'] + '</td>' +
                            /* 
                             *esta td es para la columna de acciones
                             * Eliminar empleado
                             * Editar empleado
                             * Cambiar contraseña 
                             */
                            '<td><div class="d-grid gap-2 d-md-block">' +
                            '<button type="button" class="btn btn-primary">Editar</button>' +
                            '<button type="button" class="btn btn-danger">Eliminar</button>' +
                            '</div></td>' +

                            '</tr>'; /* final de table row */


                    }
                    break;
                case false:
                    document.querySelector("#tablaEmpleados").style.display = 'none';
                    document.querySelector("#mensajesServer").style.display = 'contents';
                    document.querySelector('#mensajesServer').innerHTML = '<h1>' + json['response']['message'] + '</h1>';
                    break;
                default:
                    document.querySelector("#tablaEmpleados").style.display = 'none';
                    document.querySelector("#mensajesServer").style.display = 'contents';
                    document.querySelector('#mensajesServer').innerHTML = '<h1>Ha ocurrido un problema con el servidor</h1>';
                    break;

            }

        }

        xhttp.open("POST", base_URL + "api/readEmpleados");
        xhttp.send();


    }
</script>