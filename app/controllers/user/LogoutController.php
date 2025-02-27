<?php

use App\Models\User;
use Core\Router;

// Check if user is set in session
if (!isset($_SESSION['user'])) {
    header(Router::previousUrl());
    die();
}

unset($_SESSION['user']);

header('Location: /');