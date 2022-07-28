<?php
include_once 'config.php';

$errorsMsg = [];
$notEmpty = ['login', 'email', 'password', 'confirm_password'];

$user1 = new Worker('Ivan', 25, 1000);
$user2 = new Worker('Vasily', 26, 2000);

$salarySum = $user1->getSalary() + $user2->getSalary();

echo $salarySum;

$driver1 = new Driver('Ivan', 25, 1000, 'A');

$driver1->setCategory('D');

// $driver1->setCategory('A'); // Fatal error: Uncaught Exception: User is having this category in

// $driver1->setCategory('J'); // Error Fatal error: Uncaught Exception: Category J does not exist in

var_dump($driver1->getCategories());




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
