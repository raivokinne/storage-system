<?php

use App\Controllers\ActionsController;
use App\Controllers\AdminController;
use App\Controllers\Auth\SessionController;
use App\Controllers\Auth\UserController;
use App\Controllers\OrdersController;
use App\Controllers\PageController;
use App\Controllers\ProductsController;
use App\Controllers\ShelvesController;

global $router;

$router->get('/', [PageController::class, 'index']);

$router->get('/login', [SessionController::class, 'create']);
$router->post('/login', [SessionController::class, 'store']);

$router->get('/register', [UserController::class, 'create']);
$router->post('/register', [UserController::class, 'store']);
$router->get('/profile', [UserController::class, 'show']);

$router->get('/logout', [SessionController::class, 'destroy']);

$router->get('/orders', [OrdersController::class, 'index']);
$router->get('/orders/:id/show', [OrdersController::class, 'show']);
$router->get('/orders/create', [OrdersController::class, 'create']);
$router->post('/orders/store', [OrdersController::class, 'store']);
$router->get('/orders/:id/edit', [OrdersController::class, 'edit']);
$router->post('/orders/:id/update', [OrdersController::class, 'update']);
$router->get('/orders/:id/destroy', [OrdersController::class, 'destroy']);

$router->get('/products', [ProductsController::class, 'index']);
$router->get('/products/:id/show', [ProductsController::class, 'show']);
$router->get('/products/create', [ProductsController::class, 'create']);
$router->post('/products/store', [ProductsController::class, 'store']);
$router->get('/products/:id/edit', [ProductsController::class, 'edit']);
$router->post('/products/:id/update', [ProductsController::class, 'update']);
$router->get('/products/:id/destroy', [ProductsController::class, 'destroy']);

$router->get('/shelves', [ShelvesController::class, 'index']);
$router->get('/shelves/:id/show', [ShelvesController::class, 'show']);
$router->get('/shelves/create', [ShelvesController::class, 'create']);
$router->post('/shelves/store', [ShelvesController::class, 'store']);
$router->get('/shelves/:id/edit', [ShelvesController::class, 'edit']);
$router->post('/shelves/:id/update', [ShelvesController::class, 'update']);
$router->get('/shelves/:id/destroy', [ShelvesController::class, 'destroy']);

$router->get('/actions', [ActionsController::class, 'index']);

$router->get('/admin', [AdminController::class, 'index']);
$router->get('/admin/logs', [AdminController::class, 'actions']);
$router->get('/admin/users', [AdminController::class, 'users']);
$router->get('/admin/users/:id/edit', [AdminController::class, 'editUser']);
$router->post('/admin/users/:id/update', [AdminController::class, 'updateUser']);
$router->get('/admin/users/:id/terminate', [AdminController::class, 'terminateSession']);
$router->get('/admin/suppliers', [AdminController::class, 'suppliers']);
$router->get('/admin/suppliers/create', [AdminController::class, 'createSupplier']);
$router->post('/admin/suppliers/store', [AdminController::class, 'storeSupplier']);
$router->get('/admin/products', [AdminController::class, 'products']);
$router->get('/admin/products/create', [AdminController::class, 'createProduct']);
$router->post('/admin/products/store', [AdminController::class, 'storeProduct']);


$router->post('/profile/image', [UserController::class, 'image']);
