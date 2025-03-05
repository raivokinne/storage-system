<?php

use App\Models\Action;
use App\Models\User;
use Core\Request;
use Core\Session;
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

function component($component, $attributes = []): void
{
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
        return 'Invalid password.';
    } else {
        return 'Invalid password.';
    }
}

function request(string $field)
{
    if (isset($_FILES[$field])) {
        return $_FILES[$field];
    } else if (isset($_POST[$field])) {
        return $_POST[$field];
    } else if (isset($_GET[$field])) {
        return $_GET[$field];
    } else {
        return '';
    }
}

/**
 * Does the same shit as the php redirect() function but automatically saves the completed action to Actions table.
 *
 * @param string $path
 * @param mixed $old_value
 * @param mixed $new_value
 * @param string|null $model
 * @param string|null $method
 * @return void
 */
#[NoReturn] function redirect_and_save(string $path, mixed $old_value, mixed $new_value , string $model = null, string $method = null): void
{
    $backtrace = debug_backtrace();

    // Caller
    $info = $backtrace[1];

    // Full controller path for the file that is calling
    $controllerFull = explode('\\', $info['class']);

    // Just the controller name
    $controllerName = array_pop($controllerFull);
    $email = $_SESSION['user']['email'];
    $user_id = User::where('email', '=' , $email)->get()['ID'];
    $method = $method ?? $info['function'];
    $action = in_array($method, ['destroy', 'store', 'update']) ? $method : 'other';
    $model = $model ?? str_replace('Controller', '', $controllerName);

    Action::create(compact('user_id', 'action', 'model', 'model', 'old_value', 'new_value'));

    redirect($path);
}
