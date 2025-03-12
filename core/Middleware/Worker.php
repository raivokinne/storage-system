<?php

namespace Core\Middleware;

class Worker {
	public function handle(): void
	{
		if ($_SESSION['user']['role'] == 'worker') {
			header('Location: /');
			die();
		}
	}
}

