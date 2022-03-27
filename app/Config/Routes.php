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
$routes->setDefaultNamespace('App\Controllers\Front');
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
$routes->group('Front', ['namespace' => 'App\Controllers\Front'], function ($routes) {

    /* Home */
    $routes->get('', 'Home::index', ['as' => 'home']);

    /*Unidades*/
    $routes->get('unidades', 'Unidades::index');
    $routes->get('nuevaunidad', 'Unidades::nuevo');
    $routes->get('unidadeseliminadas', 'Unidades::eliminado');
    $routes->get('editarunidad/(:num)', 'Unidades::editar::/$1');
    $routes->get('activarunidad/(:num)', 'Unidades::activar::/$1');
    $routes->post('actualizarunidad', 'Unidades::actualizar');
    $routes->post('crearunidad', 'Unidades::guardar');
    $routes->post('eliminarunidad(:num)', 'Unidades::eliminar::/1');

    /*Categorias*/
    $routes->get('categorias', 'Categorias::index', ['as' => 'categorias']);
    $routes->get('nuevacategoria', 'Categorias::nuevo', ['as' => 'nuevacategoria']);
    $routes->get('categoriaseliminadas', 'Categorias::eliminado', ['as' => 'categoriaeliminadas']);
    $routes->get('editarcategoria/(:num)', 'Categorias::editar::/$1', ['as' => 'editarcategoria(:num)']);
    $routes->get('activarcategoria/(:num)', 'Categorias::activar::/$1', ['as' => 'activarcategoria(:num)']);
    $routes->post('actualizarcategoria', 'Categorias::actualizar', ['as' => 'actualizarcategoria']);
    $routes->post('crearcategoria', 'Categorias::guardar', ['as' => 'crearcategoria']);
    $routes->post('eliminarcategoria(:num)', 'Categorias::eliminar::/1', ['as' => 'eliminarcategoria(:num)']);
});




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
