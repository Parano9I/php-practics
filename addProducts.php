<?php
include_once 'config.php';
include_once 'helpers/mergeArrs.php';

$message = null;

if (isset($_FILES['products']) && $_FILES['products']['error'] === UPLOAD_ERR_OK) {
    if ($_FILES['products']['type'] === 'application/json') {
        $tmpFilePath = $_FILES['products']['tmp_name'];
        $tmpProductsJSON = file_get_contents($tmpFilePath);
        $tmpProducts = json_decode($tmpProductsJSON, true);

        $productsJSON = file_get_contents(ROOT_PATH . '/resources/products.json');
        $products = json_decode($productsJSON, true);

        $newProducts = mergeArrs($products, $tmpProducts);

        $newProductsJSON = json_encode($newProducts);
        file_put_contents(ROOT_PATH . '/resources/products.json', $newProductsJSON);
    }
}


include_once 'Views/addProducts.php';