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
    $routes->get('', 'Home::index',['as' => 'home']);
    $routes->get('unidades', 'Unidades::index',['as' => 'unidades']);
    $routes->get('nuevaunidad', 'Unidades::nuevo',['as' => 'nuevaunidad']);
    $routes->get('unidadeseliminadas', 'Unidades::eliminado',['as' => 'unidadeseliminadas']);
    $routes->get('editarunidad/(:num)', 'Unidades::editar::/$1',['as' => 'editarunidad(:num)']);
    $routes->post('actualizarunidad', 'Unidades::guardar',['as' => 'actualizarunidad']);
    $routes->post('crearunidad', 'Unidades::guardar',['as' => 'crearunidad']);
    $routes->get('eliminarunidad', 'Unidades::eliminar',['as' => 'eliminarunidad']);
    $routes->get('categorias', 'Home::categorias',['as' => 'categorias']);
    
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
