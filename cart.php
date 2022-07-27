<?php
include_once 'config.php';

if (!$user->isAuth()) {
    header('Location: /signin.php');
}

$cart->setUserId($_SESSION['userId']);

if (!empty($_POST)) {
    $productId = $_POST['productId'];
    
    $cart->removeProduct($productId);
}

$products = $cart->getProducts();

include_once 'Views/cart.php';
