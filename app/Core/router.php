<?php

$url = parse_url($_SERVER['REQUEST_URI'])["path"]  ?? '/';

$routes = require "../app/routes.php";

if (array_key_exists($url, $routes)) {
    require $routes[$url];
}else{
    http_response_code(404);
    require "../app/Controllers/404.php";
}