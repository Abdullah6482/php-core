<?php
use Core\Authenticator;
//log out the user

$log_out = new Authenticator();
$log_out->logout();

header('location: /');
exit();
