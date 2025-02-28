<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\User;
use Core\Request;
use Core\Validator;
use Core\Session;

class UserController extends Controller
{
    public function create()
    {
        if (isset($_SESSION['user'])) {
            redirect('/');
        }

        return view('register', ['title' => 'Register']);
    }

    public function store(Request $request)
    {
        if (isset($_SESSION['user'])) {
            redirect('/');
        }

        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $errors = [];

        if (strlen($name) < 2 || strlen($name) > 50) {
            $errors['name'] = 'Name must be between 2 and 50 characters';
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) < 2 || strlen($email) > 50) {
            $errors['email'] = 'Email must be valid and between 2 and 50 characters';
        }

        if (strlen($password) < 8 || strlen($password) > 50) {
            $errors['password'] = 'Password must be between 8 and 50 characters';
        }

        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{8,}$/', $password)) {
            $errors['password'] = 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character';
        }

        if (count($errors) > 0) {
            Session::flash('errors', $errors);
            Session::put('old', compact('name', 'email'));
            redirect('/register');
        }

        if (User::where('name', '=', $name)->get()) {
            Session::flash('errors', ['name' => 'User already exists']);
            Session::put('old', compact('name', 'email'));
            redirect('/register');
        }

        if (User::where('email', '=', $email)->get()) {
            Session::flash('errors', ['email' => 'User already exists']);
            Session::put('old', compact('name', 'email'));
            redirect('/register');
        }

        $password = password_hash($password, PASSWORD_BCRYPT);

        $result = User::create(compact('name', 'email', 'password'));
        if (!$result) {
            Session::flash('errors', ['form' => 'Failed to create user']);
            Session::put('old', compact('name', 'email'));
            redirect('/register');
        }

        $user = $result->get();
        if (!is_array($user)) {
            Session::flash('errors', ['form' => 'Failed to retrieve user data']);
            Session::put('old', compact('name', 'email'));
            redirect('/register');
        }

        unset($user['password']);
        $_SESSION['user'] = $user;

        redirect('/');
    }
}