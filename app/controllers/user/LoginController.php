<?php

use App\Models\User;
use Core\Router;
use Core\Session;

// Check if user is set in session
if (isset($_SESSION['user'])) {
    header(Router::previousUrl());
    die();
}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        view('login');
        break;
    case 'POST':
        $name = $_POST['name'];
        $password = $_POST['password'];

        $user = User::where('name', '=', $name)->get();

        if (empty($user) || !password_verify($password, $user['password'])) {
            Session::flash('errors', ['password' => 'Invalid username or password']);
            Session::put('old', compact('name', 'password'));
            header('Location: /login');
            die();
        }

        unset($user['password']);

        $_SESSION['user'] = $user;

        header('Location: /');
        break;
}