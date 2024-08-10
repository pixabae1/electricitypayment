<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->addRedirect('/', 'dashboard');

$routes->match(['get', 'post'], '/register', 'AuthController::register', ['filter' => 'auth']);
$routes->match(['get', 'post'], '/login', 'AuthController::login', ['filter' => 'auth']);
$routes->get('logout', 'AuthController::logout');

$routes->group('dashboard', ['filter' => 'auth'], static function ($routes) {
  $routes->get('/', 'dashboard\OverviewController::get');
  $routes->presenter('penggunaan', ['controller' => 'dashboard\PenggunaanController']);
  $routes->presenter('tagihan', ['controller' => 'dashboard\TagihanController']);
  $routes->presenter('pembayaran', ['controller' => 'dashboard\PembayaranController']);
});
