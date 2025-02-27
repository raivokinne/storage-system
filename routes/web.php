<?php

global $router;

$router->get('/', 'PageController');

$router->get('/about', 'PageController@about');