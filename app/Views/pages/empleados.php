<h1>Empleados</h1>
<!-- Inicio Contenido -->

<!-- DIV para un contenido o header de presentacion -->
<div class=" container text-center">
    <img class="d-block mx-auto mb-4" src="<?= base_url('img/TUIMAGEN.png') ?>" alt="" width="326" height="182">
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

<div id="result">

</div>
<!-- Fin Contenido -->

<script>
    window.onload = myFunction;

    function myFunction() {
        console.log("hola");
        /*
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                document.getElementById("demo").innerHTML = this.responseText;
            }
            xhttp.open("POST", "demo_post.asp");
            xhttp.send();

            */
    }
</script>