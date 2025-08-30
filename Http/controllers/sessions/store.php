<?php

// Log in the user if the credentials are correct
use Http\Forms\LoginForm;
use Core\App;
use Core\Database;


$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

if(!$form->validate($email,$password)) {
    return view('sessions/create.view.php',[
        'errors' => $form->errors()
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








