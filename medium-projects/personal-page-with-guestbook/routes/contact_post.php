<?php
//CSRF protection
if(!validateCsrfToken($_POST['csrfToken'] ?? null)){
    addFlashMessage('error', 'Please send the form again');
    redirect('/contact');
}

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

if(empty($name) || empty($email) || empty($message)){
    badRequest();
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    badRequest("Email field is invalid");
}

$inserted = insertMessage(
    connectDb(), 
    name: $name, 
    email: $email, 
    message: $message
);

if($inserted){
    $safeName = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    addFlashMessage('success', "Thank you, $safeName for your message");
    redirect('/guestbook');
}

addFlashMessage('error', 'Could not store the message, sorry');
redirect('/guestbook');