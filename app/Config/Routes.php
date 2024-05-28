<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');

//route admin dashboard
$routes->get('dashboard', 'Dashboard::index');

// route prodi
$routes->get('prodi', 'Prodi::index');
$routes->post('/prodi/create', 'Prodi::create');

$routes->get('prodi/ubah/(:num)', 'Prodi::ubah/$1');
   

$routes->delete('/prodi/delete/(:num)', 'Prodi::delete/$1');


// Divisi routes
$routes->get('/divisi', 'Divisi::index');
$routes->get('/divisi/create', 'Divisi::create');
$routes->post('/divisi/create', 'Divisi::create');
$routes->get('/divisi/edit/(:num)', 'Divisi::edit/$1');
$routes->post('/divisi/update/(:num)', 'Divisi::update/$1');
$routes->delete('/divisi/delete/(:num)', 'Divisi::delete/$1');