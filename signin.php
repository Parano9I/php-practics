<?php
include_once 'config.php';

$errorsMsg = [];

if (!empty($_POST)) {
    if (empty($_POST['login'])) {
        $errorsMsg['login'] = 'Login is required';
    } else {
        $stmt = $db->prepare("SELECT id, password FROM users WHERE `login` = :login");
        $stmt->execute(["login" => $_POST['login']]);
        $user = $stmt->fetch();
        $isVerifyPass = !$user ?: password_verify($_POST['password'], $user['password']);

        if ($user && $isVerifyPass) {
            $userId = $user['id'];
            $_SESSION['userId'] = $userId;
            if (!empty($_POST['remember'])) {
                setcookie("userId", $userId, time() + 3600);
            }
            header('Location: /products.php');
        } else $errorsMsg['login'] = 'Wrong login or password';
    }

    if (empty($_POST['password'])) {
        $errorsMsg['password'] = 'Password is required';
    }
}

include_once 'Views/signIn.php';
