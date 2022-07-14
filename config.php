<?php
declare(strict_types=1);
error_reporting(E_ALL);

mb_internal_encoding('utf-8');

session_start();

if(empty($_SESSION['userId']) && !empty($_COOKIE['userId'])){
  $_SESSION['userId'] = $_COOKIE['userId'];
} else header('Location: ');

define('ROOT_PATH', dirname(__FILE__));
const SALT = '6834_@#%ghjtiodjkghjdlvbjg';
const USERS_JSON_PATH = ROOT_PATH . '/resources/users.json';
const CARTS_JSON_PATH = ROOT_PATH . '/resources/carts.json';
const PRODUCTS_JSON_PATH = ROOT_PATH . '/resources/products.json';

