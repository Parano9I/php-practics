<?php
include_once 'config.php';

$errorsMsg = [];
$notEmpty = ['login', 'email', 'password', 'confirm_password'];

if (!empty($_POST)) {
    foreach ($_POST as $key => $value) {
        if (in_array($key, $notEmpty) && empty($value)) {
            $errorsMsg[$key] = ucfirst($key) . ' is required';
        }
    }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && empty($errorsMsg['email'])) {
        $errorsMsg['email'] = 'Email is invalid';
    }

    if ($_POST['password'] !== $_POST['confirm_password']) {
        $errorsMsg['password'] = 'Password was not confirmed';
    }

    if (empty($errorsMsg)) {
        try {
            $user = User::setUser(
                $_POST['login'],
                $_POST['password'],
                $_POST['email'],
            );
            $user->signUp();
            $user->login();
            header('Location: /products.php');
        } catch (Exception $err) {
            $errorsMsg['error'] = $err->getMessage();
        }
    }
}


include_once 'Views/signUp.php';
