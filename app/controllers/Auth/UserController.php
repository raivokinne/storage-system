<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\User;
use Core\Authenticator;
use Core\FileUpload;
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
        if (!auth()) {redirect('/');}

        if (request('image')['size'] !== 0) {
            $file = new FileUpload('image');
            $file->path('/users/');
            $file->createRandomName();
            $file->upload();

            // Get ready to save the new image to the DB
            $image = 'storage/users/' . $file->newFileName . $file->extension;
            $email = $_SESSION['user']['email'];
            $id = User::where('email', '=' , $email)->get()['ID'];

            // Delete the old image URL
            unlink($_SESSION['user']['image']);

            // Save the new image URL to the DB
            User::update($id, compact('image'));
        } else if (request('image_url')) {
            $image = request('image_url');
        } else {
            redirect('/profile');
        }

        // Regenerate the session picture to display the new one
        $_SESSION['user']['image'] = $image;

        redirect('/profile');
    }
}