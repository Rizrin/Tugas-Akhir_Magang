<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/usulan/input', 'Usulan::input');
$routes->post('/usulan/submit', 'Usulan::submit');
$routes->get('/usulan/success/(:num)', 'Usulan::success/$1');
$routes->get('/usulan/draft', 'Usulan::draft');
$routes->get('/usulan/riwayat', 'Usulan::riwayat');
$routes->get('/usulan/exportPdf', 'Usulan::exportPdf');
$routes->get('/usulan/exportExcel', 'Usulan::exportExcel');

$routes->get('/usulanssh/input', 'UsulanSsh::input');
$routes->post('/usulanssh/submit', 'UsulanSsh::submit');
$routes->get('/usulanssh/success/(:num)', 'UsulanSsh::success/$1');
$routes->get('/usulanssh/draft', 'UsulanSsh::draft');
$routes->get('/usulanssh/riwayat', 'UsulanSsh::riwayat');
$routes->get('/usulanssh/exportPdf', 'UsulanSsh::exportPdf');   
$routes->get('/usulanssh/exportExcel', 'UsulanSsh::exportExcel');
