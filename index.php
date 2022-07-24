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
    $stmt = $db->prepare("SELECT id FROM users WHERE `email` = :email");
    $stmt->execute(["email" => $_POST['email']]);
    if (!empty($stmt->fetchColumn())) {
        $errorsMsg['email'] = "Email {$_POST['email']} is already used";
    }

    $stmt = $db->prepare("SELECT id FROM users WHERE `login` = :login");
    $stmt->execute(["login" => $_POST['login']]);
    if (!empty($stmt->fetchColumn())) {
        $errorsMsg['login'] = "Login {$_POST['login']} is already used";
    }

    if ($_POST['password'] !== $_POST['confirm_password']) {
        $errorsMsg['password'] = 'Password was not confirmed';
    }

    if (empty($errorsMsg)) {
        $stmt = $db->prepare("INSERT INTO users (login, email, password) VALUES (:login, :email, :password)");
        $stmt->execute([
            "login" => $_POST['login'],
            "email" => $_POST['email'],
            "password" => password_hash($_POST['password'], PASSWORD_DEFAULT)
        ]);
        $id = $db->lastInsertId();
        $_SESSION['userId'] = $id;
        if (isset($_POST['remember'])) {
            setcookie("userId", $id, time() + 3600);
        };
        header('Location: /products.php');
    }
}


include_once 'Views/signUp.php';
