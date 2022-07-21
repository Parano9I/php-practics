<?php
include_once 'config.php';

if (!isset($_SESSION['userId'])) {
    header('Location: /signin.php');
}

$carts = json_decode(file_get_contents(CARTS_JSON_PATH), true);
$products = json_decode(file_get_contents(PRODUCTS_JSON_PATH), true);
$userId = $_SESSION['userId'];

$productsId = [...array_filter($carts, function ($userCart) use ($userId) {
    return $userCart['userId'] === $userId;
})][0]['items'];

$cartProducts = array_map(function ($id) use ($products) {
    $productId = array_search($id, array_column($products, 'id'));
    return $products[$productId];
}, $productsId);

include_once 'Views/cart.php';
