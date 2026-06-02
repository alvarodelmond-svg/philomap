<?php
// index.php - Ponto de Entrada & Container de Injeção de Dependência

// Configuração do ambiente
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
use App\Repositories\InscricaoRepository;
use App\Services\InscricaoService;
use App\Controller\InscricaoController;
use App\Router\Router;

try {
    // --- CONTAINER DE INJEÇÃO DE DEPENDÊNCIA (DI) ---
    
    // 1. Singleton Database
    $db = Database::getInstance()->getConnection();

    // 2. Injeção: DB -> Repositório
    $inscricaoRepository = new InscricaoRepository($db);

    // 3. Injeção: Repositório -> Service
    $inscricaoService = new InscricaoService($inscricaoRepository);

    // 4. Injeção: Service -> Controller
    $inscricaoController = new InscricaoController($inscricaoService);

    // 5. Injeção: Controller -> Router
    $router = new Router($inscricaoController);

    // Executa a aplicação
    $router->handleRequest();

} catch (\Exception $e) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false, 
        'message' => 'Erro crítico no sistema.',
        'error' => $e->getMessage()
    ]);
}
