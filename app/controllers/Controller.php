<?php

namespace App\Controllers;

abstract class Controller
{
	public function incorrectPayload(string $view, array $errors)
	{
		return view($view, [
			'errors' => $errors
		]);
	}
}
