<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Rutas Página Web
$routes->get('/', 'Reporte::vw_mapa');


//Rutas panel de administración LIBRES
 $routes->get('/usuario/login', 'Usuario::vw_login');
 $routes->post('/usuario/acceder', 'Usuario::fn_login');
 $routes->get('/usuario/cerrar-sesion', 'Usuario::fn_cerrarsesion');



//Rutas panel de administración VALIDADAS
 $routes->post('/reporte/guardar', 'Reporte::guardar');


$routes->get('/api/mapa', 'Reporte::api');


$routes->get('/mapa', 'Reporte::vw_mapa');
$routes->get('/mapa/filtrar/(:any)', 'Reporte::filtrar/$1');
$routes->get('/mapa/detalle/(:num)', 'Reporte::detalle/$1');

$routes->group('auth', static function ($routes) {

    // --- PERFIL ---
    //$routes->get('mi-perfil', 'Usuarios::vw_miPerfil');

    // --- USUARIOS ---
    $routes->group('usuarios', static function ($routes) {
        $routes->get('/', 'Usuario::vw_cuentas');
        $routes->post('filtrar', 'Usuarios::fn_getUsuarios');

        $routes->group('usuario', static function ($routes) {
        });
    });
});

$routes->get('users', 'Usuario::index');
$routes->get('users/list', 'Usuario::list');
$routes->post('users/create', 'Usuario::create');
$routes->get('users/get/(:num)', 'Usuario::get/$1');
$routes->post('users/update/(:num)', 'Usuario::update/$1');
$routes->get('users/delete/(:num)', 'Usuario::delete/$1');
