<?php

global $router;

$router->get('/', 'PageController');

$router->get('/about', 'PageController@about');

$router->get('/login', 'user/LoginController');
$router->post('/login', 'user/LoginController');

$router->get('/register', 'user/RegisterController');
$router->post('/register', 'user/RegisterController');

$router->get('/logout', 'user/LogoutController');