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
$routes->setDefaultMethod('dashboard');
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
$routes->group('', ['filter' => 'login'], function ($routes) {
    $routes->get('dashboard', 'Home::dashboard');
    $routes->get('contacts', 'ContactsController::index');
    $routes->add('contacts', 'ContactsController::create');
    $routes->add('contacts/edit/(:segment)', 'ContactsController::edit/$1');
    $routes->get('contacts/delete/(:segment)', 'ContactsController::delete/$1');
    $routes->get('obat', 'ObatController::index');
    $routes->get('obat/download_file/(:any)', 'ObatController::download/$1');
    $routes->add('obat/create', 'ObatController::create');
    $routes->post('obat/edit/(:segment)', 'ObatController::edit/$1');
    $routes->post('obat/verifikasi/(:segment)', 'ObatController::verifikasi/$1');
    $routes->get('obat/delete/(:segment)', 'ObatController::delete/$1');
    $routes->post('obat/tolak/(:segment)', 'ObatController::tolak/$1');
    $routes->get('profile', 'ProfileController::index');
    $routes->post('profile/edit', 'ProfileController::edit');
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
