<?php

use Core\Response;
use Core\Session;

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function authorize($condition, $status = Response::FORBIDDEN)
{
    if (! $condition) {
        abort($status);
    }
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);

    require base_path('views/' . $path);
}


function redirect($path)
{
    header("location: {$path}");
    exit();
}


function currentUserId($db) {
    $email = $_SESSION['user']['email'] ?? null;

    if (!$email) {
        return null;
    }

    $user = $db->query(
        "SELECT id FROM users WHERE email = :email",
        ['email' => $email]
    )->find();

    return $user['id'] ?? null;
}

function old($key,$default = ''){
        return Session::get('old')[$key] ?? $default;
}

