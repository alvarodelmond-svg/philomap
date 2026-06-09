<?php

namespace App\Model;

use PDO;
use PDOException;
use Exception;

class Database {
    private static ?PDO $instance = null;

    private function __construct() {}
    private function __clone() {}

    /**
     * Retorna a instância única do PDO conectada ao banco SQLite.
     */
    public static function getConnection(): PDO {
        if (self::$instance === null) {
            $configPath = __DIR__ . '/../../config.ini';

            if (!file_exists($configPath)) {
                throw new Exception("Arquivo de configuração config.ini não foi encontrado.");
            }

            $config = parse_ini_file($configPath, true);

            if (!isset($config['database'])) {
                throw new Exception("Seção [database] ausente no config.ini.");
            }

            $dbConfig = $config['database'];

            try {
                // Resolve o caminho físico do banco SQLite a partir do diretório atual
                $relativeDbPath = __DIR__ . '/../../' . $dbConfig['path'];
                $dsn = sprintf("%s:%s", $dbConfig['driver'], $relativeDbPath);

                self::$instance = new PDO($dsn, null, null, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);

                // Ativa restrições de chaves estrangeiras no SQLite
                self::$instance->exec("PRAGMA foreign_keys = ON;");

            } catch (PDOException $e) {
                throw new Exception("Erro de conexão com o banco SQLite: " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}