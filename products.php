<?php
include_once 'config.php';

if (!$user->isAuth()) {
    header('Location: /signin.php');
}

$cart->setUserId($_SESSION['userId']);

if (!empty($_POST)) {
    $productId = $_POST['productId'];
    $amount = $_POST['amount'];

    $cart->addProduct($productId, $amount);
}

$products = $product->getAll();
$productsInCart = array_column($cart->getProductsId(), 'id');

$isDisabledBuy = fn ($productId) => in_array($productId, $productsInCart) ? 'disabled' : '';


include_once 'Views/products.php';
