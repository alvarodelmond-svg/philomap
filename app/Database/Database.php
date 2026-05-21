<?php

namespace App\Database;

use PDO;
use PDOException;

/**
 * Classe Database - Gerencia a conexão com o banco de dados SQLite (Singleton).
 */
class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        try {
            // Usa o caminho definido no config.php
            $dsn = "sqlite:" . DB_PATH;
            
            $this->conn = new PDO($dsn);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            throw new PDOException("Erro ao conectar ao SQLite: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}
