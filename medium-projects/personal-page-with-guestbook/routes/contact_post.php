<?php
//CSRF
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

if(empty($name) || empty($email) || empty($message)){
    badRequest();
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    badRequest("Email field is invalid");
}

connectDb();

var_dump($email, $name, $message);die;