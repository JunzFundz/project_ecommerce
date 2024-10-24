<?php

namespace Classes;
require __DIR__ . "/../../vendor/autoload.php";

use PDO;
use PDOException;

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . "/../../");
$dotenv->load();

class Connection {
    private $pdo;

    public function __construct() {
        try {
            $dsn = "mysql:host={$_ENV['DATABASE_HOSTNAME']};dbname={$_ENV['DATABASE_DBNAME']};charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $this->pdo = new PDO($dsn, $_ENV['DATABASE_USERNAME'], $_ENV['DATABASE_PASSWORD'], $options);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getPdo() {
        return $this->pdo;
    }
}
