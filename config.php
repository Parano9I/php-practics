<?php

declare(strict_types=1);
error_reporting(E_ALL);
mb_internal_encoding('utf-8');

use Shop\User;
use Dotenv\Dotenv;

define('ROOT_PATH', dirname(__FILE__));

require_once ROOT_PATH . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

session_start();

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

if (User::isAuth() && !empty($_COOKIE['userId'])) {
    $_SESSION['userId'] = $_COOKIE['userId'];
}