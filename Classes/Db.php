<?php
class Db
{
    private static $instance = null;
    private $conn;

    private function __construct()
    {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charse=' . DB_CHARSET;
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        $this->conn = new PDO($dsn, DB_USER, DB_PASS, $opt);
    }

    public static function getInstance(): Db
    {
        if (self::$instance == null) {
            self::$instance = new Db();
        }

        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->conn;
    }
}
