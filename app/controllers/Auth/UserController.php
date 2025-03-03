<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\User;
use Core\Authenticator;
use Core\Request;
use Core\Validator;
use Core\Session;

class UserController extends Controller
{
    public function show(): void
    {
        if (!isset($_SESSION['user'])) {
            redirect('/');
        }

        view('auth/profile', ['title' => 'Profile']);
        return;
    }
    public function create(): void
    {
        if (isset($_SESSION['user'])) {
            redirect('/');
        }

        view('auth/register', ['title' => 'Register']);
        return;
    }

    public function store(Request $request)
    {
        if (auth()) {redirect('/');}

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6'
        ]);

        $name = request('name');
        $email = request('email');
        $password = hash_make(request('password'));
        $image = 'images/user.png';

        User::create(compact('name', 'email', 'password', 'image'));

        $user = User::where('email', '=', $email)->get();

        Authenticator::login($user);

        redirect('/');
    }

    public function image(Request $request): void
    {
        $request->validate([
            'image' => 'required|image',
            'image_url' => 'required|url'
        ]);
    }
}