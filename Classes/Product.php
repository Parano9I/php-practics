<?php
class Product
{
    public static function getAll(PDO $db): array
    {
        $stmt = $db->query('SELECT * FROM products');
        return $stmt->fetchAll();
    }
}
