<?php

declare(strict_types=1);
error_reporting(E_ALL);
mb_internal_encoding('utf-8');

use Shop\User;

define('ROOT_PATH', dirname(__FILE__));
define('SALT', '6834_@#%ghjtiodjkghjdlvbjg');
define('IMAGE_URL', 'https://dummyjson.com/image/i/products/');

define('DB_HOST', 'localhost');
define('DB_NAME', 'shop_lamp_dev');
define('DB_USER', 'client');
define('DB_PASS', 'client');
define('DB_CHARSET', 'utf8');

session_start();

spl_autoload_register(function ($className) {
    $classDir = 'Classes' . DIRECTORY_SEPARATOR;
    $namespaceElments = explode('\\', $className);
    $class = array_pop($namespaceElments);
    $namespace = array_pop($namespaceElments);
    $subDirs = $namespaceElments;
    $classPath = $classDir . implode('/', [...$subDirs, $class]) . '.php';

    require_once($classPath);
});


if (User::isAuth() && !empty($_COOKIE['userId'])) {
    $_SESSION['userId'] = $_COOKIE['userId'];
}