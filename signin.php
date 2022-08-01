<?php
include_once 'config.php';

use Shop\User;
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log = new Logger('name');
$log->pushHandler(new StreamHandler(__DIR__ . DIRECTORY_SEPARATOR . $_ENV['LOG_FILE_PATH'], Level::Warning));

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
            $log->error('Error login: ' . $err->getMessage());
        }
    }
}

include_once 'Views/signIn.php';