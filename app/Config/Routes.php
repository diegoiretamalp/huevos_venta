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
$routes->setDefaultController('LoginController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
// $routes->set404Override();
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
$routes->get('iconos', 'MainController::iconos', ['filter' => 'auth']);


$routes->get('/', 'MainController::index', ['filter' => 'auth']);
#LOGIN 
$routes->get('login', 'LoginController::index');
$routes->post('login', 'LoginController::index');
$routes->get('restablecer-password', 'LoginController::CorreoRestablecer');
$routes->post('restablecer-password', 'LoginController::CorreoRestablecer');
// $routes->get('restablecer/(:any)', 'LoginController::');
$routes->get('new-password/(:any)', 'LoginController::restablecerContrasenia/$1');
$routes->post('new-password/(:any)', 'LoginController::restablecerContrasenia/$1');
$routes->get('cambiar-password', 'LoginController::cambiar_password');
$routes->post('cambiar-password', 'LoginController::cambiar_password');
$routes->get('sesion-finalizada', 'LoginController::SesionFinaliza');
$routes->get('logout', 'LoginController::logout');
$routes->set404Override(static function () {
    echo '<script>window.location.href = "' . base_url('/') . '";</script>';
});
// $routes->set404Override('App\ErroresController::error404', ['filter' => 'auth']);


#RUTAS DE MANTENEDOR DE VENTAS
$routes->get('ventas/listado', 'VentasController::index', ['filter' => 'auth', 'rutasFilter']);
$routes->get('ventas/nueva', 'VentasController::NuevaVenta', ['filter' => ['auth', 'rutasFilter']]);
$routes->post('ventas/nueva', 'VentasController::NuevaVenta', ['filter' => ['auth', 'rutasFilter']]);
$routes->get('ventas/editar/(:num)', 'VentasController::EditarVenta', ['filter' => ['auth', 'rutasFilter']]);
$routes->post('ventas/editar/(:num)', 'VentasController::EditarVenta', ['filter' => ['auth', 'rutasFilter']]);
$routes->post('ventas/eliminar', 'VentasController::EliminarVenta', ['filter' => ['auth', 'rutasFilter']]);
$routes->post('ventas/obtener-cliente', 'VentasController::ObtenerCliente', ['filter' => ['auth', 'rutasFilter']]);

$routes->get('ventas/detalle/(:num)', 'VentasController::VerDetalleVenta/$1', ['filter' => ['auth', 'rutasFilter']]);

#RUTAS DE MANTENEDOR DE CLIENTES
$routes->get('clientes/listado', 'ClientesController::index', ['filter' => ['auth', 'rutasFilter']]);
$routes->get('clientes/nuevo', 'ClientesController::NuevoCliente', ['filter' => ['auth', 'rutasFilter']]);
$routes->post('clientes/nuevo', 'ClientesController::NuevoCliente', ['filter' => ['auth', 'rutasFilter']]);
$routes->get('clientes/ver/(:num)', 'ClientesController::VerCliente/$1', ['filter' => ['auth', 'rutasFilter']]);
$routes->post('clientes/ver/(:num)', 'ClientesController::VerCliente/$1', ['filter' => ['auth', 'rutasFilter']]);
$routes->get('clientes/editar/(:num)', 'ClientesController::EditarCliente/$1', ['filter' => ['auth', 'rutasFilter']]);
$routes->post('clientes/editar/(:num)', 'ClientesController::EditarCliente/$1', ['filter' => ['auth', 'rutasFilter']]);
$routes->post('clientes/eliminar', 'ClientesController::EliminarCliente', ['filter' => ['auth', 'rutasFilter']]);

#RUTAS DE MANTENEDOR DE DEUDAS

$routes->get('deudas/listado', 'DeudasController::index', ['filter' => 'auth']);
$routes->get('deudas/nueva', 'DeudasController::NuevaDeuda', ['filter' => 'auth']);
$routes->post('deudas/nueva', 'DeudasController::NuevaDeuda', ['filter' => 'auth']);
$routes->get('deudas/editar/(:num)', 'DeudasController::EditarDeuda/$1', ['filter' => 'auth']);
$routes->post('deudas/editar/(:num)', 'DeudasController::EditarDeuda/$1', ['filter' => 'auth']);
$routes->post('deudas/eliminar', 'DeudasController::EliminarDeuda', ['filter' => 'auth']);
$routes->get('deudas/ver/(:num)', 'DeudasController::VerRuta/$1', ['filter' => 'auth']);


#RUTAS DE MANTENEDOR DE PRODUCTOS

$routes->get('productos/listado', 'ProductosController::index', ['filter' => ['auth', 'rutasFilter']]);
$routes->get('productos/nuevo', 'ProductosController::NuevoProducto', ['filter' => ['auth', 'rutasFilter']]);
$routes->post('productos/nuevo', 'ProductosController::NuevoProducto', ['filter' => ['auth', 'rutasFilter']]);
$routes->get('productos/editar/(:num)', 'ProductosController::EditarProducto/$1', ['filter' => ['auth', 'rutasFilter']]);
$routes->post('productos/editar/(:num)', 'ProductosController::EditarProducto/$1', ['filter' => ['auth', 'rutasFilter']]);
$routes->post('productos/eliminar', 'ProductosController::EliminarProducto', ['filter' => ['auth', 'rutasFilter']]);


#RUTAS DE MANTENEDOR DE USUARIOS

$routes->get('usuarios/listado', 'UsuariosController::index', ['filter' => ['auth', 'rutasFilter']]);
$routes->get('usuarios/nuevo', 'UsuariosController::NuevoUsuario', ['filter' => ['auth', 'rutasFilter']]);
$routes->post('usuarios/nuevo', 'UsuariosController::NuevoUsuario', ['filter' => ['auth', 'rutasFilter']]);
$routes->get('usuarios/editar/(:num)', 'UsuariosController::EditarUsuario/$1', ['filter' => ['auth', 'rutasFilter']]);
$routes->post('usuarios/editar/(:num)', 'UsuariosController::EditarUsuario/$1', ['filter' => ['auth', 'rutasFilter']]);
$routes->post('usuarios/eliminar', 'UsuariosController::EliminarUsuario', ['filter' => ['auth', 'rutasFilter']]);





#RUTAS DE MANTENEDOR DE SECTORES
$routes->get('sectores/listado', 'SectoresController::index', ['filter' => ['auth', 'rutasFilter']]);
$routes->get('sectores/nuevo', 'SectoresController::NuevoSector', ['filter' => ['auth', 'rutasFilter']]);
$routes->post('sectores/nuevo', 'SectoresController::NuevoSector', ['filter' => ['auth', 'rutasFilter']]);
$routes->get('sectores/editar/(:num)', 'SectoresController::EditarSector/$1', ['filter' => ['auth', 'rutasFilter']]);
$routes->post('sectores/editar/(:num)', 'SectoresController::EditarSector/$1', ['filter' => ['auth', 'rutasFilter']]);
$routes->post('sectores/eliminar', 'SectoresController::EliminarSector', ['filter' => ['auth', 'rutasFilter']]);

#RUTAS DE MANTENEDOR DE RUTAS
$routes->get('rutas/listado', 'RutasController::index', ['filter' => 'auth']);
$routes->get('rutas/nueva', 'RutasController::NuevaRuta', ['filter' => 'auth']);
$routes->post('rutas/nueva', 'RutasController::NuevaRuta', ['filter' => 'auth']);
$routes->get('rutas/editar/(:num)', 'RutasController::EditarRuta/$1', ['filter' => 'auth']);
$routes->post('rutas/editar/(:num)', 'RutasController::EditarRuta/$1', ['filter' => 'auth']);
$routes->get('rutas/ver/(:num)', 'RutasController::VerRuta/$1', ['filter' => 'auth']);
$routes->post('rutas/eliminar', 'RutasController::EliminarRuta', ['filter' => 'auth']);
$routes->get('rutas/cerrar-ruta/(:num)', 'RutasController::CerrarRuta/$1', ['filter' => 'auth']);
$routes->post('ruta/obtener-deuda-cliente/(:num)', 'RutasController::CargarDeudasCliente/$1', ['filter' => 'auth']);
$routes->post('ruta/pagar-deuda/(:num)', 'RutasController::PagarDeudaCliente/$1', ['filter' => 'auth']);

$routes->post('ventas/nueva-venta-ruta', 'VentasController::NuevaVentaRuta', ['filter' => 'auth']);

#RUTAS DE GASTOS
$routes->post('gastos/eliminar-gasto/(:num)', 'GastosController::EliminarGasto/$1', ['filter' => 'auth']);
$routes->post('gastos/nuevo-gasto-ruta', 'GastosController::NuevoGastoRuta', ['filter' => 'auth']);

$routes->post('clientes/cargar-cliente-venta/(:num)', 'RutasController::CargarClienteVenta/$1', ['filter' => 'auth']);
$routes->post('clientes/cargar-primera-venta', 'RutasController::CargarPrimeraVenta', ['filter' => 'auth']);
$routes->post('clientes/obtener-cliente/(:num)', 'RutasController::ObtenerClienteRuta/$1', ['filter' => 'auth']);
$routes->get('clientes/obtener-deudas/(:num)', 'RutasController::CargarDeudaCliente/$1', ['filter' => 'auth']);
$routes->post('clientes/obtener-clientes-ruta', 'RutasController::ObtenerClientesRuta', ['filter' => 'auth']);
$routes->post('clientes/obtener-clientes-grupo', 'RutasController::ObtenerClientesGrupo', ['filter' => 'auth']);

#RUTAS DE MANTENEDOR DE GRUPOS
$routes->get('grupos/listado', 'GruposController::index', ['filter' => 'auth']);
$routes->get('grupos/nuevo', 'GruposController::NuevoGrupo', ['filter' => 'auth']);
$routes->post('grupos/nuevo', 'GruposController::NuevoGrupo', ['filter' => 'auth']);
$routes->get('grupos/editar/(:num)', 'GruposController::EditarGrupo/$1', ['filter' => 'auth']);
$routes->post('grupos/editar/(:num)', 'GruposController::EditarGrupo/$1', ['filter' => 'auth']);
$routes->post('grupos/eliminar', 'GruposController::EliminarGrupo', ['filter' => 'auth']);

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
