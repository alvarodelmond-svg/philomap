<?php
class Database {
    private static $instance = null;

    private function __construct() {} 

    public static function getConnection() {
        if (self::$instance === null) {
            $configFile = __DIR__ . '/../config.ini';
            
            // Verifica se é uma requisição AJAX
            $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' || 
                      (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false);

            if (!file_exists($configFile)) {
                self::sendError("Arquivo 'config.ini' não encontrado.", $isAjax);
            }

            $config = parse_ini_file($configFile);
            if ($config === false) {
                self::sendError("Não foi possível ler o arquivo 'config.ini'.", $isAjax);
            }

            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8";
            
            try {
                self::$instance = new PDO($dsn, $config['user'], $config['password'], [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]);
            } catch (PDOException $e) {
                self::sendError("Erro de Banco: " . $e->getMessage(), $isAjax);
            }
        }
        return self::$instance;
    }

    private static function sendError($message, $isAjax) {
        if ($isAjax) {
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $message]);
            exit;
        } else {
            die("Erro fatal: " . $message);
        }
    }
}