<?php
include_once 'config.php';

if (!User::isAuth()) {
    header('Location: /signin.php');
}

$userId = User::getId();
$db = Db::getInstance()->getConnection();

if (!empty($_POST)) {
    $productId = $_POST['productId'];
    
    Cart::removeProduct($db, $userId, $productId);
}

$products = Cart::getProducts($db, $userId);

include_once 'Views/cart.php';
