<?php

use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\LogoutController;
use App\Controllers\Auth\RegisterController;
use App\Controllers\PageController;

global $router;

$router->get('/', [PageController::class, 'index']);

$router->get('/login', [LoginController::class, 'create']);
$router->post('/login', [LoginController::class, 'store']);

$router->get('/register', [RegisterController::class, 'create']);
$router->post('/register', [RegisterController::class, 'store']);

$router->get('/logout', [LogoutController::class, 'destroy']);