<?php

use App\Controllers\Auth\SessionController;
use App\Controllers\Auth\UserController;
use App\Controllers\PageController;
use App\Controllers\TestController;
use App\Controllers\OrdersController;
use App\Controllers\ShelvesController;
use App\Controllers\ProductsController;
use App\Controllers\ActionsController;

global $router;

$router->get('/', [PageController::class, 'index']);

$router->get('/login', [SessionController::class, 'create']);
$router->post('/login', [SessionController::class, 'store']);

$router->get('/register', [UserController::class, 'create']);
$router->post('/register', [UserController::class, 'store']);
$router->get('/profile', [UserController::class, 'show']);

$router->get('/logout', [SessionController::class, 'destroy']);

$router->post('/upload', [TestController::class, 'test']);
$router->get('/upload', [TestController::class, 'idk']);


$router->get('/orders', [OrdersController::class, 'index']);
$router->get('/orders/show', [OrdersController::class, 'show']);
$router->get('/orders/create', [OrdersController::class, 'create']);
$router->post('/orders/store', [OrdersController::class, 'store']);
$router->get('/orders/edit', [OrdersController::class, 'edit']);
$router->post('/orders/update', [OrdersController::class, 'update']);
$router->get('/orders/destroy', [OrdersController::class, 'destroy']);

$router->get('/products', [ProductsController::class, 'index']);
$router->get('/products/show', [ProductsController::class, 'show']);
$router->get('/products/create', [ProductsController::class, 'create']);
$router->post('/products/store', [ProductsController::class, 'store']);
$router->get('/products/edit', [ProductsController::class, 'edit']);
$router->post('/products/update', [ProductsController::class, 'update']);
$router->get('/products/destroy', [ProductsController::class, 'destroy']);


$router->get('/shelves', [ShelvesController::class, 'index']);
$router->get('/shelves/show', [ShelvesController::class, 'show']);
$router->get('/shelves/create', [ShelvesController::class, 'create']);
$router->post('/shelves/store', [ShelvesController::class, 'store']);
$router->get('/shelves/edit', [ShelvesController::class, 'edit']);
$router->post('/shelves/update', [ShelvesController::class, 'update']);
$router->get('/shelves/destroy', [ShelvesController::class, 'destroy']);

$router->get('/actions', [ActionsController::class, 'index']);