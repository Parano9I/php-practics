<?php

namespace Shop;

use \PDO;

class Cart
{
    public static function getProducts(PDO $db, int $userId): array
    {
        $stmt = $db->prepare(
            'SELECT 
                p.id,
                p.title, 
                p.price, 
                c.amount, 
                p.price, 
                c.amount*p.price as total_price, 
                p.image,  
                p.description 
            FROM carts c 
            INNER JOIN products p ON c.product_id = p.id
            WHERE user_id = :userId;'
        );
        $stmt->execute([
            "userId" => $userId
        ]);
        return $stmt->fetchAll();
    }

    public static function getProductsId(PDO $db, int $userId): array
    {
        $stmt = $db->prepare(
            'SELECT p.id
            FROM carts c 
            INNER JOIN products p ON c.product_id = p.id
            WHERE user_id = :userId;'
        );
        $stmt->execute([
            "userId" => $userId
        ]);
        return $stmt->fetchAll();
    }

    public static function removeProduct(PDO $db, int $userId, int $productId): void
    {
        $stmt = $db->prepare(
            'DELETE FROM carts 
            WHERE product_id = :productId AND user_id = :userId'
        );
        $stmt->execute([
            "userId" => $userId,
            "productId" => $productId
        ]);
    }

    public static function addProduct(PDO $db, int $userId, int $productId, int $amount)
    {
        $stmt = $db->prepare(
            "INSERT INTO carts (product_id, user_id, amount) 
                VALUES (:product_id, :user_id, :amount)"
        );
        $stmt->execute([
            "product_id" => $productId,
            "user_id" => $userId,
            "amount" => $amount
        ]);
    }
}
