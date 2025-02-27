<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\User;
use Core\Validator;

class RegisterController extends Controller
{
	public function create()
	{
		return view('register/create');
	}

	public function store()
	{
		$validator = Validator::make($_POST, [
			'name' => 'required|min:3|max:255',
			'email' => 'required|min:3|max:255|email',
			'password' => 'required|min:3|max:255',
			'password_confirmation' => 'required|min:3|max:255'
		]);

		if ($validator->fails()) {
			$this->incorrectPayload('register/create', $validator->errors());
		}

		$validated = $validator->validated();
		if ($validated['password'] === $validated['password_confirmation']) {
			$this->incorrectPayload('register/create', ['Password dont match']);
		}

		$user = User::create([
			'name' => $validated['name'],
			'email' => $validated['email'],
			'password' => hash_make($validated['password']),
		]);
	}
}
