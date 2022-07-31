<?php
include_once 'config.php';

use Shop\User;

$errorsMsg = [];

if (!empty($_POST)) {
    if (empty($_POST['login'])) {
        $errorsMsg['login'] = 'Login is required';
    }
    if (empty($_POST['password'])) {
        $errorsMsg['password'] = 'Password is required';
    }
    if (empty($errorsMsg)) {
        $isRemember = empty($_POST['remember']) ? false : true;
        try {
            $user = User::setUser(
                $_POST['login'],
                $_POST['password']
            );
            $user->login($isRemember);
            header('Location: /products.php');
        } catch (Exception $err) {
            $errorsMsg['error'] = $err->getMessage();
        }
    }
}

include_once 'Views/signIn.php';
