<?php

use App\Models\User;
use Core\Router;
use Core\Session;
use Core\Validator;

// Check if user is set in session
if (isset($_SESSION['user'])) {
    header(Router::previousUrl());
    die();
}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        view('register');
        break;
    case 'POST':
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (Validator::string($name, 2, 50) === false) {
            Session::flash('errors', ['name' => 'Name must be between 2 and 50 characters']);
        }

        if (Validator::email($email, 2, 50) === false) {
            Session::flash('errors', ['email' => 'Email must be valid and between 2 and 50 characters']);
        }

        if (Validator::string($password, 8, 50) === false) {
            Session::flash('errors', ['password' => 'Password must be between 8 and 50 characters']);
        }

        if (Validator::password($password) === false) {
            Session::flash('errors', ['password' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character']);
        }
        if (isset($_SESSION['_flash']['errors']) && count($_SESSION['_flash']['errors']) > 0) {
            Session::put('old', compact('name', 'email', 'password'));
            header('Location: /register');
            die();
        }

        if (User::where('name', '=', $name)->get()) {
            Session::flash('errors', ['name' => 'User already exists']);
            Session::put('old', compact('name', 'email', 'password'));
            header('Location: /register');
            die();
        }
        if (User::where('email', '=', $email)->get()) {
            Session::flash('errors', ['email' => 'User already exists']);
            Session::put('old', compact('name', 'email', 'password'));
            header('Location: /register');
            die();
        }

        $password = password_hash($password, PASSWORD_BCRYPT);

        $user = User::create(compact('name', 'email', 'password'))->get();

        unset($user['password']);

        $_SESSION['user'] = $user;

        header('Location: /');
        break;
}