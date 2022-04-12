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
    /* $routes->get('', 'Home::index', ['as' => 'home']); */

    /* Unidades*/
    $routes->get('unidades/', 'Unidades::index');
    $routes->get('nuevaunidad/', 'Unidades::nuevo');
    $routes->get('unidadeseliminadas/', 'Unidades::eliminado');
    $routes->get('editarunidad/(:num)', 'Unidades::editar::/$1');
    $routes->get('activarunidad/(:num)', 'Unidades::activar::/$1');
    $routes->post('actualizarunidad/', 'Unidades::actualizar');
    $routes->post('crearunidad/', 'Unidades::guardar');
    $routes->get('eliminarunidad/(:num)', 'Unidades::eliminar::/$1');

    /* Categorias*/
    $routes->get('categorias', 'Categorias::index');
    $routes->get('nuevacategoria', 'Categorias::nuevo');
    $routes->get('categoriaseliminadas', 'Categorias::eliminado');
    $routes->get('editarcategoria/(:num)', 'Categorias::editar::/$1');
    $routes->get('activarcategoria/(:num)', 'Categorias::activar::/$1');
    $routes->post('actualizarcategoria', 'Categorias::actualizar');
    $routes->post('crearcategoria', 'Categorias::guardar');
    $routes->get('eliminarcategoria/(:num)', 'Categorias::eliminar::/$1');

    /* Productos*/
    $routes->get('productos', 'Productos::index');
    $routes->get('nuevoproducto', 'Productos::nuevo');
    $routes->get('productoseliminados', 'Productos::eliminado');
    $routes->get('editarproducto/(:num)', 'Productos::editar::/$1');
    $routes->get('activarproducto/(:num)', 'Productos::activar::/$1');
    $routes->post('actualizarproducto', 'Productos::actualizar');
    $routes->post('crearproducto', 'Productos::guardar');
    $routes->get('eliminarproducto/(:num)', 'Productos::eliminar::/$1');

    /* Clientes */
    $routes->get('clientes', 'Clientes::index');
    $routes->get('nuevocliente', 'Clientes::nuevo');
    $routes->get('clienteseliminados', 'Clientes::eliminado');
    $routes->get('editarcliente/(:num)', 'Clientes::editar::/$1');
    $routes->get('activarclientes/(:num)', 'Clientes::activar::/$1');
    $routes->post('actualizarcliente', 'Clientes::actualizar');
    $routes->post('crearcliente', 'Clientes::guardar');
    $routes->get('eliminarcliente/(:num)', 'Clientes::eliminar::/$1');

    /* Configuracion */
    $routes->get('configuracion', 'Configuracion::index');
    $routes->get('editarconfiguracion', 'Configuracion::editar');
    $routes->post('actualizarconfiguracion', 'Configuracion::actualizar');

    /* Caja */
    $routes->get('caja', 'caja::index');
    $routes->get('nuevacaja', 'Caja::nuevo');
    $routes->get('cajaeliminada', 'Caja::eliminado');
    $routes->get('editarcaja/(:num)', 'Caja::editar::/$1');
    $routes->get('activarcaja/(:num)', 'Caja::activar::/$1');
    $routes->post('actualizarcaja', 'Caja::actualizar');
    $routes->post('crearcaja', 'Caja::guardar');
    $routes->get('eliminarcaja/(:num)', 'Caja::eliminar::/$1');

    /* Roles */
    $routes->get('roles', 'Roles::index');
    $routes->get('nuevorol', 'Roles::nuevo');
    $routes->get('roleliminado', 'Roles::eliminado');
    $routes->get('editarrol/(:num)', 'Roles::editar::/$1');
    $routes->get('activarrol/(:num)', 'Roles::activar::/$1');
    $routes->post('actualizarrol', 'Roles::actualizar');
    $routes->post('crearrol', 'Roles::guardar');
    $routes->get('eliminarrol/(:num)', 'Roles::eliminar::/$1');

    /* Usuarios */
    $routes->get('usuarios', 'Usuarios::index');
    $routes->get('nuevousuario', 'Usuarios::nuevo');
    $routes->post('crearusuario', 'Usuarios::guardar');
    $routes->post('editarusuario', 'Usuarios::editar');
    $routes->post('actualizarusuario', 'Usuarios::actualizar');
    $routes->get('activarusuario/(:num)', 'Usuarios::activar::/$1');
    $routes->get('eliminarusuario/(:num)', 'Usuarios::eliminar::/$1');
    $routes->get('usuarioseliminados', 'Usuarios::eliminado');
    $routes->get('cambiapassword', 'Usuarios::cambiar_password');
    $routes->post('actualizarpassword', 'Usuarios::actualizar_password');


    /* Login */
    $routes->get('login', 'Usuarios::login');
    $routes->post('validarlogin', 'Usuarios::valida');

    /*Validaciones*/
    $routes->get('frvalidar', 'Form::verformulario');
    $routes->post('vld', 'Form::vld');
    
    /* Compras */
    $routes->get('compras', 'Compras:index');
    $routes->get('nuevacompra', 'Compras::nuevo');
    $routes->post('agregacompra', 'TemporalCompras::guardar');
    $routes->post('listar', 'TemporalCompras::listarCompras');
    $routes->get('sacar', 'Productos::sacarDeInvetario');

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
