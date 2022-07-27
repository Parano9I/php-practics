<?php
class Cart
{
    private PDO $db;
    private int $userId;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getProducts(): array
    {
        $stmt = $this->db->prepare(
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
            "userId" => $this->userId
        ]);
        return $stmt->fetchAll();
    }

    public function getProductsId(): array
    {
        $stmt = $this->db->prepare(
            'SELECT p.id
            FROM carts c 
            INNER JOIN products p ON c.product_id = p.id
            WHERE user_id = :userId;'
        );
        $stmt->execute([
            "userId" => $this->userId
        ]);
        return $stmt->fetchAll();
    }

    public function removeProduct(int $productId): void
    {
        $productId = $_POST['productId'];
        $stmt = $this->db->prepare(
            'DELETE FROM carts 
            WHERE product_id = :productId AND user_id = :userId'
            );
            $stmt->execute([
                "userId" => $this->userId,
                "productId" => $productId
            ]);
        }

        public function addProduct(int $productId, int $amount)
        {
            $stmt = $this->db->prepare(
                "INSERT INTO carts (product_id, user_id, amount) 
                VALUES (:product_id, :user_id, :amount)"
            );
            $stmt->execute([
                "product_id" => $productId,
                "user_id" => $this->userId,
                "amount" => $amount
            ]);
        }
    }
