<?php
class Database {
    private static $instance = null;

    private function __construct() {} 

    public static function getConnection() {
        if (self::$instance === null) {
            // Este caminho (../config.ini) sobe uma pasta para achar o arquivo
            $config = parse_ini_file(__DIR__ . '/../config.ini');
            
            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8";
            
            try {
                self::$instance = new PDO($dsn, $config['user'], $config['password'], [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]);
            } catch (PDOException $e) {
                die("Erro na conexão: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}