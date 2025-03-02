<?php

namespace App\Controllers\Auth;

use App\Models\User;
use Core\Router;

class LogoutController
{
    public function destroy()
    {
        if (!isset($_SESSION['auth'])) {
            header(Router::previousUrl());
            die();
        }

        unset($_SESSION['auth']);

        header('Location: /');
    }
}