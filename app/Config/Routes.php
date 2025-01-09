<?php

use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\LogoutController;
use App\Controllers\DashboardController;
use App\Controllers\ProductController;
use App\Controllers\TransactionController;
use App\Controllers\UnitController;
use App\Controllers\UserController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/login', [LoginController::class, 'index'], ['filter' => 'auth:guest']);
$routes->post('/login', [LoginController::class, 'login'], ['filter' => 'auth:guest']);



$routes->group('', ['filter' => 'auth:protect'], function ($routes) {
    $routes->get('/', [DashboardController::class, 'index']);
    $routes->delete('/logout', [LogoutController::class, 'logout']);

    // * Routes User
    $routes->get('/users', [UserController::class, 'index']);
    $routes->get('/users/create', [UserController::class, 'create']);
    $routes->post('/users/store', [UserController::class, 'store']);
    $routes->get('/users/edit/(:num)', [UserController::class, 'edit']);
    $routes->put('/users/update/(:num)', [UserController::class, 'update']);
    $routes->delete('/users/delete/(:num)', [UserController::class, 'delete']);

    // * Routes Units
    $routes->get('/units', [UnitController::class, 'index']);
    $routes->get('/units/create', [UnitController::class, 'create']);
    $routes->post('/units/store', [UnitController::class, 'store']);
    $routes->get('/units/edit/(:num)', [UnitController::class, 'edit']);
    $routes->put('/units/update/(:num)', [UnitController::class, 'update']);
    $routes->delete('/units/delete/(:num)', [UnitController::class, 'delete']);

    // * Routes Products
    $routes->get('/products', [ProductController::class, 'index']);
    $routes->get('/products/create', [ProductController::class, 'create']);
    $routes->post('/products/store', [ProductController::class, 'store']);
    $routes->get('/products/edit/(:num)', [ProductController::class, 'edit']);
    $routes->put('/products/update/(:num)', [ProductController::class, 'update']);
    $routes->delete('/products/delete/(:num)', [ProductController::class, 'delete']);

    // * Routes Transactions
    $routes->get('/transactions', [TransactionController::class, 'index']);
    $routes->get('/transactions/create', [TransactionController::class, 'create']);
    $routes->post('/transactions/store', [TransactionController::class, 'store']);
    $routes->get('/transactions/show/(:num)', [TransactionController::class, 'show']);
    $routes->get('/transactions/edit/(:num)', [TransactionController::class, 'edit']);
    $routes->put('/transactions/update/(:num)', [TransactionController::class, 'update']);
    $routes->delete('/transactions/delete/(:num)', [TransactionController::class, 'delete']);
});
