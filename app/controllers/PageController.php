<?php

namespace App\Controllers;

use App\Models\User;

$user = User::all();

return view('index.php', [
	'id' => 1
]);
