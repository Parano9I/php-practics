<?php
include_once 'config.php';

if (!isset($_SESSION['userId'])) {
    header('Location: /signin.php');
}

$userId = $_SESSION['userId'];

var_dump($userId);

if (!empty($_POST)) {
    $stmt = $db->prepare(
        "INSERT INTO carts (product_id, user_id, amount) 
        VALUES (:product_id, :user_id, :amount)"
    );
    $stmt->execute([
        "product_id" => $_POST['product_id'],
        "user_id" => $userId,
        "amount" => $_POST['amount']
    ]);
}


$stmt = $db->query('SELECT * FROM products LIMIT 12');
$products = $stmt->fetchAll();

$stmt = $db->prepare('SELECT product_id FROM carts WHERE user_id = :userId');
$stmt->execute([
    "userId" => $userId,
]);
$productsInCart = array_column($stmt->fetchAll(), 'product_id');

$isDisabledBuy = fn ($productId) => in_array($productId, $productsInCart) ? 'disabled' : '';


include_once 'Views/products.php';
