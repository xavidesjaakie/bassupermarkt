<?php
require_once __DIR__ . '/../config/config.php';

class Database {

    private $conn;

    public function connect() {

        $this->conn = null;

        try {

            $this->conn = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
                DB_USER,
                DB_PASS
            );

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e) {

            die("Database connectie mislukt: " . $e->getMessage());

        }

        return $this->conn;
    }
}
