<?php
include_once 'config.php';

use Shop\User;
use Shop\Tasks\{
    User as Person,
    Worker,
    Driver
};
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log = new Logger('name');
$log->pushHandler(new StreamHandler(__DIR__ . DIRECTORY_SEPARATOR . $_ENV['LOG_FILE_PATH'], Level::Warning));


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
            $userData = [
                'login' => $_POST['login'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
            ];
            $errorsMsg['error'] = $err->getMessage();
            $log->error(
                'Error registration: ' .
                    $err->getMessage() .
                    ' ' .
                    json_encode($userData)
            );
        }
    }
}


include_once 'Views/signUp.php';
