<?php
include_once 'config.php';

$productsJson = file_get_contents(ROOT_PATH . '/resources/products.json');
$products = json_decode($productsJson, true);





include_once 'Views/products.php';

