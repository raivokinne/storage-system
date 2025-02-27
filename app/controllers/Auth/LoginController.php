<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\User;
use Core\Validator;
use Core\Authenticator;

class LoginController extends Controller
{
	public function create()
	{
		return view('login/create');
	}

	public function store()
	{
		$validator = Validator::make($_POST, [
			'email' => 'required|email',
			'password' => 'required',
		]);

		if ($validator->fails()) {
			$this->incorrectPayload('login/create', $validator->errors());
		}

		$validated = $validator->validated();

		$user = User::where('email', '=', $validated['email'])->get();
		$errors = [];

		if (!$user) {
			$errors['user'] = 'User does not exist';
			if (count($errors) > 0) {
				return view(
					'login/create',
					[
						'title' => 'Login',
						'errors' => $errors
					]
				);
			}
		} else {
			(new Authenticator())->attempt($validated['email'], $validated['password']);

			redirect('/');
		}
	}
}

