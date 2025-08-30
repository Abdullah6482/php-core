<?php

// Log in the user if the credentials are correct

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];
if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address.';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please provide a password .';
}
if(!empty($errors)){
    return view('sessions/create.view.php',[
        'error' => $errors
    ]);
}

//match the credentials

$user = $db->query('select * from users where email = :email',[
    'email' => $email
])->find();


if($user){
    if(password_verify($password,$user['password']))
    {
        login([
            'email' => $email
        ]);

        header('location: /');
        exit();

    }
}

//user is found, but password isn't verified yet



return view('sessions/create.view.php',[
    'errors' => [
        'found' => 'No matching account found for the email address and password.'
    ]
]);








