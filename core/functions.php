<?php

use JetBrains\PhpStorm\NoReturn;

#[NoReturn] function dd($value): void
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

#[NoReturn] function abort($code = 404): void
{
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
    return $_POST[$key] ?? '';
}