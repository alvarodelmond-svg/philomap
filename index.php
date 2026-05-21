<?php
// index.php

// Se estiver usando o servidor embutido do PHP, permite que arquivos estáticos (CSS, JS, Imagens) sejam servidos diretamente
if (php_sapi_name() === 'cli-server') {
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if (is_file(__DIR__ . $path)) {
        return false;
    }
}

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/autoload.php';

session_start();

use App\Database\Database;
use App\Router\Router;

try {
    // 1. Obtém a conexão com o banco de dados
    $db = Database::getInstance()->getConnection();

    // 2. Inicializa o Roteador e processa a requisição
    $router = new Router($db);
    $router->handleRequest();

} catch (\Exception $e) {
    // Fallback de erro crítico
    http_response_code(500);
    if (!headers_sent()) {
        header('Content-Type: application/json');
    }
    echo json_encode([
        'success' => false, 
        'message' => 'Erro fatal na inicialização do sistema.',
        'debug' => $e->getMessage()
    ]);
}
