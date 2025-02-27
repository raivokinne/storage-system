<?php

namespace App\Controllers;

use App\Models\User;

$user = User::all();
$id = 1;

view('index', compact('id'));


