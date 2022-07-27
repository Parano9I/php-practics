<?php

declare(strict_types=1);
error_reporting(E_ALL);

mb_internal_encoding('utf-8');

require_once('Classes/User.php');
require_once('Classes/Product.php');
require_once('Classes/Cart.php');

define('ROOT_PATH', dirname(__FILE__));
define('SALT', '6834_@#%ghjtiodjkghjdlvbjg');
define('IMAGE_URL', 'https://dummyjson.com/image/i/products/');

define('DB_HOST', 'localhost');
define('DB_NAME', 'shop_lamp_dev');
define('DB_USER', 'client');
define('DB_PASS', 'client');
define('DB_CHARSET', 'utf8');

session_start();

$dsn = 'mysql:host='. DB_HOST . ';dbname=' . DB_NAME . ';charse=' . DB_CHARSET;
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];
$db = new PDO($dsn, DB_USER, DB_PASS, $opt);

$user = new User($db);
$product = new Product($db);
$cart = new Cart($db);

if ($user->isAuth() && !empty($_COOKIE['userId'])) {
    $_SESSION['userId'] = $_COOKIE['userId'];
}



