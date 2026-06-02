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
            $config = parse_ini_file(__DIR__ . '/../../config.ini', true);
            $dbPath = __DIR__ . '/../../' . $config['database']['path'];
            
            // Garante que o diretório existe
            $dir = dirname($dbPath);
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }

            $dsn = "sqlite:" . $dbPath;
            
            $this->conn = new \PDO($dsn);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            
            // Inicializa a tabela se não existir (Opcional, mas bom para garantir que o projeto rode)
            $this->conn->exec("CREATE TABLE IF NOT EXISTS inscricoes (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                nome TEXT NOT NULL,
                idade INTEGER NOT NULL,
                estudo TEXT NOT NULL,
                data_inscricao DATETIME DEFAULT CURRENT_TIMESTAMP
            )");
            
        } catch (\PDOException $e) {
            throw new \PDOException("Erro ao conectar ao SQLite: " . $e->getMessage());
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
