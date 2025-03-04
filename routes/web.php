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

$router->post('/profile/image', [UserController::class, 'image']);

$router->get('/orders', [OrdersController::class, 'index']);
$router->get('/shelves', [ShelvesController::class, 'index']);
$router->get('/products', [ProductsController::class, 'index']);
$router->get('/actions', [ActionsController::class, 'index']);