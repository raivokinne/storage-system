<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\User;
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

        view('login', ['title' => 'Login']);
        return;
    }

    public function store()
    {
        if (isset($_SESSION['user'])) {
            redirect(Router::previousUrl());
        }

        $validator = Validator::make($_POST, [
            'name' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $this->incorrectPayload('login', $validator->errors());
        }

        $validated = $validator->validated();
        $name = $validated['name'];
        $password = $validated['password'];

        $user = User::where('name', '=', $name)->get();

        if (!$user || !password_verify($password, $user['password'])) {
            Session::flash('errors', ['password' => 'Invalid username or password']);
            Session::put('old', ['name' => $name]);
            redirect('/login');
        }

        unset($user['password']);

        $_SESSION['user'] = $user;

        redirect('/');
    }

    public function destroy()
    {
        if (!isset($_SESSION['user'])) {
            header(Router::previousUrl());
            die();
        }

        unset($_SESSION['user']);

        header('Location: /');
    }
}