<?php

use Core\Session;
use JetBrains\PhpStorm\NoReturn;

function dd($value): void
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

#[NoReturn] function abort($code = 404): void
{
    http_response_code($code);
    http_response_code($code);
    require base_path("views/{$code}.php");
    die();
}

function base_path($path): string
{
    return BASE_PATH . $path;
}

function view($path, $attributes = []): void
{
    extract($attributes);

    require base_path('views/' . $path . '.view.php');
}

#[NoReturn] function redirect($path): void
{
    header("location: {$path}");
    exit();
}

function component($component, $attributes = []): void {
    extract($attributes);
    require base_path('views/components/' . $component . '.php');
}

function auth(): bool
{
    return isset($_SESSION['user']);
}

function old($key): string
{
    return Session::get('old')[$key] ?? '';
}

function error($key): string
{
    $errors = Session::get('errors');
    if ($errors) {
        if (array_key_exists($key, $errors)) {
            return "<p class='text-red-500 font-light text-sm pb-1' >{$errors[$key]}</p>";
        }
    }
    return '';
}

function hash_make($password): string
{
    return password_hash($password, PASSWORD_DEFAULT);
}

function hash_check($one, $two): string
{
    if (password_verify($one, $two)) {
        echo 'Password is valid!';
    } else {
        echo 'Invalid password.';
    }
}
