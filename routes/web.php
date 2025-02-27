<?php

use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\RegisterController;
use App\Controllers\PageController;
use Core\Router;

Router::get('/', [PageController::class, 'index']);
Router::get('/', [LoginController::class, 'create']);
Router::post('/', [LoginController::class, 'store']);
Router::get('/', [RegisterController::class, 'create']);
Router::post('/', [RegisterController::class, 'store']);
