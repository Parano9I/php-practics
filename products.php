<?php
include_once 'config.php';

if (!file_exists(CARTS_JSON_PATH)) {
    $usersFile = fopen(CARTS_JSON_PATH, 'a');
    fwrite($usersFile, json_encode([]));
    fclose($usersFile);
}

if (!empty($_POST)) {
    $carts = json_decode(file_get_contents(CARTS_JSON_PATH), true);
    $products = json_decode(file_get_contents(PRODUCTS_JSON_PATH), true);

    $productId = $_POST['productId'];
    $userId = $_SESSION['userId'];

    $userCart = [...array_filter($carts, function ($cart) use ($userId) {
        return $userId === $cart['userId'];
    })][0];

    if ($userCart) {
        array_push($userCart['items'], $productId);
        // array_replace($carts, $userCart);
        $carts = array_map(function ($cart) use ($userCart) {
            if ($cart['userId'] === $userCart['userId']) {
                return $userCart;
            } else return $cart;
        }, $carts);
    } else {
        $cart = [
            'userId' => $userId,
            'items' => [$productId],
        ];
        array_push($carts, $cart);
    }
    file_put_contents(CARTS_JSON_PATH, json_encode($carts));
}

$productsJson = file_get_contents(PRODUCTS_JSON_PATH);
$products = json_decode($productsJson, true);





include_once 'Views/products.php';
