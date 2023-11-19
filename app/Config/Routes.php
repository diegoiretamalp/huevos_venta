<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('MainController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'MainController::index');
$routes->get('iconos', 'MainController::iconos');

#RUTAS DE MANTENEDOR DE VENTAS
$routes->get('ventas/listado', 'VentasController::index');
$routes->get('ventas/nueva', 'VentasController::NuevaVenta');
$routes->post('ventas/nueva', 'VentasController::NuevaVenta');
$routes->get('ventas/editar/(:num)', 'VentasController::EditarVenta');
$routes->post('ventas/editar/(:num)', 'VentasController::EditarVenta');
$routes->post('ventas/eliminar', 'VentasController::EliminarVenta');
$routes->post('ventas/obtener-cliente', 'VentasController::ObtenerCliente');

$routes->post('ventas/nueva-venta-ruta', 'VentasController::NuevaVentaRuta');

#RUTAS DE MANTENEDOR DE CLIENTES
$routes->get('clientes/listado', 'ClientesController::index');
$routes->get('clientes/nuevo', 'ClientesController::NuevoCliente');
$routes->post('clientes/nuevo', 'ClientesController::NuevoCliente');
$routes->get('clientes/ver/(:num)', 'ClientesController::VerCliente/$1');
$routes->post('clientes/ver/(:num)', 'ClientesController::VerCliente/$1');
$routes->get('clientes/editar/(:num)', 'ClientesController::EditarCliente/$1');
$routes->post('clientes/editar/(:num)', 'ClientesController::EditarCliente/$1');
$routes->post('clientes/eliminar', 'ClientesController::EliminarCliente');

#RUTAS DE MANTENEDOR DE DEUDAS

$routes->get('deudas/listado', 'DeudasController::index');
$routes->get('deudas/nueva', 'DeudasController::NuevaDeuda');
$routes->post('deudas/nueva', 'DeudasController::NuevaDeuda');
$routes->get('deudas/editar/(:num)', 'DeudasController::EditarDeuda/$1');
$routes->post('deudas/editar/(:num)', 'DeudasController::EditarDeuda/$1');
$routes->post('deudas/eliminar', 'DeudasController::EliminarDeuda');

#RUTAS DE MANTENEDOR DE PRODUCTOS

$routes->get('productos/listado', 'ProductosController::index');
$routes->get('productos/nuevo', 'ProductosController::NuevoProducto');
$routes->post('productos/nuevo', 'ProductosController::NuevoProducto');
$routes->get('productos/editar/(:num)', 'ProductosController::EditarProducto/$1');
$routes->post('productos/editar/(:num)', 'ProductosController::EditarProducto/$1');
$routes->post('productos/eliminar', 'ProductosController::EliminarProducto');


#RUTAS DE MANTENEDOR DE USUARIOS

$routes->get('usuarios/listado', 'UsuariosController::index');
$routes->get('usuarios/nuevo', 'UsuariosController::NuevoUsuario');
$routes->post('usuarios/nuevo', 'UsuariosController::NuevoUsuario');
$routes->get('usuarios/editar/(:num)', 'UsuariosController::EditarUsuario/$1');
$routes->post('usuarios/editar/(:num)', 'UsuariosController::EditarUsuario/$1');
$routes->post('usuarios/eliminar', 'UsuariosController::EliminarUsuario');

#RUTAS DE MANTENEDOR DE RUTAS

$routes->get('rutas/listado', 'RutasController::index');
$routes->get('rutas/nueva', 'RutasController::NuevaRuta');
$routes->post('rutas/nueva', 'RutasController::NuevaRuta');
$routes->get('rutas/editar/(:num)', 'RutasController::EditarRuta/$1');
$routes->post('rutas/editar/(:num)', 'RutasController::EditarRuta/$1');
$routes->get('rutas/ver/(:num)', 'RutasController::VerRuta/$1');
$routes->post('rutas/eliminar', 'RutasController::EliminarRuta');
$routes->post('clientes/obtener-clientes-ruta', 'RutasController::ObtenerClientesRuta');
$routes->post('clientes/obtener-cliente/(:num)', 'RutasController::ObtenerClienteRuta/$1');
$routes->post('clientes/cargar-cliente-venta/(:num)', 'RutasController::CargarClienteVenta/$1');
$routes->post('clientes/cargar-primera-venta', 'RutasController::CargarPrimeraVenta');
$routes->get('clientes/obtener-deudas/(:num)', 'RutasController::CargarDeudaCliente/$1');


#RUTAS DE MANTENEDOR DE SECTORES
$routes->get('sectores/listado', 'SectoresController::index');
$routes->get('sectores/nuevo', 'SectoresController::NuevoSector');
$routes->post('sectores/nuevo', 'SectoresController::NuevoSector');
$routes->get('sectores/editar/(:num)', 'SectoresController::EditarSector/$1');
$routes->post('sectores/editar/(:num)', 'SectoresController::EditarSector/$1');
$routes->post('sectores/eliminar', 'SectoresController::EliminarSector');

//LOGIN 
$routes->get('login/inicio', 'LoginController::index');
$routes->get('login/restablecer-password', 'LoginController::restablecer_password');
$routes->post('login/restablecer-password', 'LoginController::restablecer_password');
$routes->get('login/cambiar-password', 'LoginController::cambiar_password');
$routes->post('login/cambiar-password', 'LoginController::cambiar_password');




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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
