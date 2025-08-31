<?php

use Http\Forms\LoginForm;
use Core\Authenticator;
use Core\Session;

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

if($form->validate($email,$password)) {     // validate if the email and password valid

    $auth = new Authenticator();

    if($auth->attempt($email,$password)) { //authenticate from email->user->password->login
        redirect('/');
    }
        $form->error('email',"No matching account found for the email address and password.");
}
Session::flash('error',$form->errors());
return redirect('/login');




















