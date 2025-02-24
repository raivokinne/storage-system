<?php

const BASE_PATH = __DIR__.'/../';

session_start();

require BASE_PATH . 'vendor/autoload.php';
require BASE_PATH . 'functions.php';

$router = new \Core\Router;
require BASE_PATH . '/routes/web.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->route($uri, $method);
} catch (\Exception $e) {
    return redirect($router->previousUrl());
}


