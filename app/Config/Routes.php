<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index'); // retorna la vista del formulario de login

// lógica para el login
$routes->post('/auth/login', 'AuthController::login'); // procesa la información recibida del formulario de login para autenticar a los usuarios
$routes->get('/auth/logout', 'AuthController::logout'); // destruye la sesión del usuario

// CRUD Prestamos
$routes->get('/puestos', 'PuestoController::index');
$routes->get('/puestos/crear', 'PuestoController::crear');
$routes->post('/puestos/registrar', 'PuestoController::registrar');
$routes->get('/puestos/editar/(:num)', 'PuestoController::editar/$1');
$routes->post('/puestos/actualizar/(:num)', 'PuestoController::actualizar/$1');
$routes->get('/puestos/eliminar/(:num)', 'PuestoController::eliminar/$1');

// CRUD Prestamos
$routes->get('/prestamos', 'PrestamoController::index');
$routes->get('/solicitud', 'PrestamoController::solicitud', ['filter' => 'validarSolicitud']);
$routes->post('/prestamos/registrar', 'PrestamoController::registrar');
$routes->get('/prestamos/aprobar/(:num)', 'PrestamoController::aprobar/$1');
$routes->get('/prestamos/eliminar/(:num)', 'PrestamoController::eliminar/$1');
$routes->get('/prestamos/detalles/(:num)', 'PrestamoController::detalles/$1');

// Rutas de abonos
$routes->get('/abono/(:num)', 'AbonoController::index/$1');
$routes->get('/abono/registrar/(:num)', 'AbonoController::registrar/$1');



$routes->get('/admin', 'Home::admin');

// Opción 2 trabajar con controladores y modelos
// CRUD Empleados
$routes->get('/empleados', 'EmpleadoController::index'); // retorna el indice (tabla) de empleados
$routes->get('/empleados/crear', 'EmpleadoController::crear'); // retorna el formulario de crear nuevo empleado
$routes->post('/empleados/registrar', 'EmpleadoController::registrar'); // procesar la información del formulario de nuevo empleado
$routes->get('empleados/editar/(:num)', 'EmpleadoController::editar/$1'); // retorna el formulario para editar y la información del empleado a editar
$routes->post('empleados/actualizar/(:num)', 'EmpleadoController::actualizar/$1'); // procesar la información del formulario
$routes->get('empleados/eliminar/(:num)', 'EmpleadoController::eliminar/$1'); // eliminar un empleado por id

// * RUTAS DE REPORTES
$routes->get('/reportes', 'Home::reportes');
$routes->get('/reportes/prestamos-por-empleado', 'Home::prestamosPorEmpleado');
$routes->get('/reportes/intereses-cobrados', 'Home::interesesCobrados');

// Opción Trabajar vistas mediante Api
//ruta para cargar vistas
$routes->get('/vistas/(:any)', 'Home::view/$1');

$routes->post('api/readEmpleados', 'ApiController::readEmpleados');
$routes->post('api/ejemplo', 'ApiController::ejemplo');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
