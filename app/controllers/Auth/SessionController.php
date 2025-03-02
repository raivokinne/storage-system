<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\User;
use Core\Authenticator;
use Core\Middleware\Auth;
use Core\Request;
use Core\Validator;
use Core\Session;
use Core\Router;

class SessionController extends Controller
{
    public function create()
    {
        if (isset($_SESSION['user'])) {
            redirect(Router::previousUrl());
        }

        view('auth/login', ['title' => 'Login']);
        return;
    }

    public function store(Request $request)
    {
        if (isset($_SESSION['user'])) {
            redirect(Router::previousUrl());
        }

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $email = request('email');
        $password = request('password');
        if (!Authenticator::attempt($email, $password)) {
            Session::flash('errors', ['password' => 'Invalid username or password']);
            Session::put('old', compact('email', 'password'));
            redirect('/login');
        }

        redirect('/');
    }

    public function destroy()
    {
        if (!isset($_SESSION['user'])) {
            header(Router::previousUrl());
            die();
        }

        Authenticator::logout();

        header('Location: /');
    }
}