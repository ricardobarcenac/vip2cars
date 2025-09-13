<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Acceso');
$routes->setDefaultMethod('login');
$routes->setTranslateURIDashes(false);
/* 404 PERSONALIZADO */
$routes->set404Override(function()
{
    echo view('errors/404');
});
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Acceso::login');
$routes->get('crear-cuenta', 'Acceso::crearCuenta');
$routes->get('dashboard', 'Dashboard::dashboard');

/* ACCESO */
$routes->add('entrar','Acceso::entrar');
$routes->add('validar-codigo/(:any)','Acceso::validarCodigo/$1');
$routes->add('confirmar-codigo/(:any)','Acceso::confirmarCodigo/$1');
$routes->add('salir','Acceso::salir');
$routes->add('iniciar-sesion','Acceso::login');
$routes->add('olvido-contrasena', 'Acceso::olvidoContrasena');
$routes->add('solicitar-recuperacion', 'Acceso::solicitarRecuperacion');
$routes->add('recuperar-cuenta/(:any)', 'Acceso::recuperarCuenta/$1');
$routes->add('grabar-recuperacion/(:any)', 'Acceso::grabarRecuperacion/$1');

/* MARCAS */
$routes->add('listar-marcas','Marca::listarMarcas');
$routes->add('grabar-marca','Marca::grabarMarca');
$routes->add('obtener-info-marca','Marca::obtenerInfoMarca');
$routes->add('actualizar-marca/(:any)','Marca::actualizarMarca/$1');
$routes->add('eliminar-marca/(:any)','Marca::eliminarMarca/$1');
$routes->add('reactivar-marca/(:any)','Marca::reactivarMarca/$1');

/* MODELOS */
$routes->add('listar-modelos','Modelo::listarModelos');
$routes->add('grabar-modelo','Modelo::grabarModelo');
$routes->add('obtener-info-modelo','Modelo::obtenerInfoModelo');
$routes->add('actualizar-modelo/(:any)','Modelo::actualizarModelo/$1');
$routes->add('eliminar-modelo/(:any)','Modelo::eliminarModelo/$1');
$routes->add('reactivar-modelo/(:any)','Modelo::reactivarModelo/$1');
$routes->add('obtener-modelos','Modelo::obtenerModelos');

/* VEHICULOS */
$routes->add('listar-vehiculos','Vehiculo::listarVehiculos');
$routes->add('grabar-vehiculo','Vehiculo::grabarVehiculo');
$routes->add('obtener-info-vehiculo','Vehiculo::obtenerInfoVehiculo');
$routes->add('actualizar-vehiculo/(:any)','Vehiculo::actualizarVehiculo/$1');
$routes->add('eliminar-vehiculo/(:any)','Vehiculo::eliminarVehiculo/$1');
$routes->add('reactivar-vehiculo/(:any)','Vehiculo::reactivarVehiculo/$1');

/* CLIENTES */
$routes->add('listar-clientes','Cliente::listarClientes');
$routes->add('grabar-cliente','Cliente::grabarCliente');
$routes->add('obtener-info-cliente','Cliente::obtenerInfoCliente');
$routes->add('actualizar-cliente/(:any)','Cliente::actualizarCliente/$1');
$routes->add('eliminar-cliente/(:any)','Cliente::eliminarCliente/$1');
$routes->add('reactivar-cliente/(:any)','Cliente::reactivarCliente/$1');
$routes->add('reporte-clientes','Cliente::reporteClientes');

/* VEHICULO CLIENTE */
$routes->add('listar-vehiculos-clientes','VehiculoCliente::listarVehiculoClientes');
$routes->add('grabar-vehiculo-cliente','VehiculoCliente::grabarVehiculoCliente');
$routes->add('obtener-info-vehiculo-cliente','VehiculoCliente::obtenerInfoVehiculoCliente');
$routes->add('actualizar-vehiculo-cliente/(:any)','VehiculoCliente::actualizarVehiculoCliente/$1');
$routes->add('eliminar-vehiculo-cliente/(:any)','VehiculoCliente::eliminarVehiculoCliente/$1');
$routes->add('reactivar-vehiculo-cliente/(:any)','VehiculoCliente::reactivarVehiculoCliente/$1');

/* PERFIL */
$routes->add('listar-perfiles','Perfil::listarPerfiles');
$routes->add('obtener-datos-perfil','Perfil::obtenerDatosPerfil');
$routes->add('actualizar-perfil/(:any)','Perfil::actualizarPerfil/$1');
$routes->add('eliminar-perfil/(:any)','Perfil::eliminarPerfil/$1');
$routes->add('reactivar-perfil/(:any)','Perfil::reactivarPerfil/$1');

/* USUARIOS */
$routes->add('listar-usuarios','Usuarios::listarUsuarios');
$routes->add('grabar-usuario','Usuarios::grabarUsuario');
$routes->add('obtener-info-usuario','Usuarios::obtenerInfoUsuario');
$routes->add('actualizar-usuario/(:any)','Usuarios::actualizarUsuario/$1');
$routes->add('eliminar-usuario/(:any)','Usuarios::eliminarUsuario/$1');
$routes->add('reactivar-usuario/(:any)','Usuarios::reactivarUsuario/$1');
$routes->add('reporte-usuarios','Usuarios::reporteUsuarios');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
