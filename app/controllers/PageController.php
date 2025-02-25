<?php

namespace App\Controllers;

use App\Models\User;

$user = User::all();

return view('index.view.php', [
	'id' => 1
]);
