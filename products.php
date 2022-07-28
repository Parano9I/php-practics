<?php
include_once 'config.php';

if (!User::isAuth()) {
    header('Location: /signin.php');
}

$db = Db::getInstance()->getConnection();
$userId = User::getId();

if (!empty($_POST)) {
    $productId = $_POST['productId'];
    $amount = $_POST['amount'];

    Cart::addProduct($db, $userId, $productId, $amount);
}

$products = Product::getAll($db);

$productsInCart = array_column(Cart::getProductsId($db, $userId), 'id');

$isDisabledBuy = fn ($productId) => in_array($productId, $productsInCart) ? 'disabled' : '';


include_once 'Views/products.php';
