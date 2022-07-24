<?php
include_once 'config.php';

if (!isset($_SESSION['userId'])) {
    header('Location: /signin.php');
}

$userId = $_SESSION['userId'];

if (!empty($_POST)) {
    $productId = $_POST['productId'];
    $stmt = $db->prepare(
        'DELETE FROM carts 
        WHERE product_id = :productId AND user_id = :userId'
    );
    $stmt->execute([
        "userId" => $userId,
        "productId" => $productId
    ]);
}

$stmt = $db->prepare(
    'SELECT 
        p.id,
        p.title, 
        p.price, 
        p.amount, 
        p.price, 
        p.amount*p.price as total_price, 
        p.image,  
        p.description 
    FROM carts c 
    INNER JOIN products p ON c.product_id = p.id
    WHERE user_id = :userId;'
);
$stmt->execute([
    "userId" => $userId,
]);
$products = $stmt->fetchAll();

include_once 'Views/cart.php';
