<?php
include_once 'config.php';

$errorMsg = '';

if (!empty($_POST)) {
    $users = json_decode(file_get_contents(USERS_JSON_PATH), true);
    $postPassword = $_POST['password'];
    $user = array_filter($users, function ($user) use ($postPassword) {
        $isVerifyLogin = ($user['username'] === $_POST['username']);
        $isVerifyPass = (password_verify($postPassword, $user['password']));

        return $isVerifyLogin && $isVerifyPass ? true : false;
    });

    if (!empty($user[0])) {
        $userId = $user[0]['id'];
        $_SESSION['userId'] = $userId;
        if (!empty($_POST['remember'])) {
            setcookie("userId", $userId, time() + 3600);
        }
        header('Location: /products.php');
    } else {
        $errorMsg = 'Wrong login or password';
    }
}

include_once 'Views/signIn.php';
