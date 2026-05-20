<?php

require_once __DIR__ . '/src/Database/Database.php';
require_once __DIR__ . '/src/Models/Favorito.php';
require_once __DIR__ . '/src/Models/Inscricao.php';
require_once __DIR__ . '/src/Repositories/IConteudoRepository.php';
require_once __DIR__ . '/src/Repositories/ConteudoRepository.php';
require_once __DIR__ . '/src/Repositories/IInscricaoRepository.php';
require_once __DIR__ . '/src/Repositories/InscricaoRepository.php';
require_once __DIR__ . '/src/Exceptions/BusinessRuleException.php';
require_once __DIR__ . '/src/Services/ConteudoService.php';
require_once __DIR__ . '/src/Services/InscricaoService.php';
require_once __DIR__ . '/src/Controllers/ConteudoController.php';
require_once __DIR__ . '/src/Controllers/InscricaoController.php';
require_once __DIR__ . '/src/Middleware/Middleware.php';

use App\Database\Database;
use App\Repositories\ConteudoRepository;
use App\Repositories\InscricaoRepository;
use App\Services\ConteudoService;
use App\Services\InscricaoService;
use App\Controllers\ConteudoController;
use App\Controllers\InscricaoController;
use App\Middleware\Middleware;

header('Content-Type: application/json');

try {
    $db = Database::getInstance()->getConnection();
    
    // Routing logic
    $action = $_GET['action'] ?? '';

    switch ($action) {
        case 'favoritar':
            Middleware::validatePostRequest();
            $data = Middleware::sanitizeInput($_POST);
            $controller = new ConteudoController(new ConteudoService(new ConteudoRepository($db)));
            $controller->store($data);
            break;

        case 'listar':
            $usuario_id = (int)($_GET['usuario_id'] ?? 0);
            $controller = new ConteudoController(new ConteudoService(new ConteudoRepository($db)));
            $controller->index($usuario_id);
            break;

        case 'remover':
            Middleware::validatePostRequest();
            $data = Middleware::sanitizeInput($_POST);
            $controller = new ConteudoController(new ConteudoService(new ConteudoRepository($db)));
            $controller->destroy($data);
            break;

        case 'inscrever':
            Middleware::validatePostRequest();
            $data = Middleware::sanitizeInput($_POST);
            $controller = new InscricaoController(new InscricaoService(new InscricaoRepository($db)));
            $controller->store($data);
            break;

        default:
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Rota não encontrada.']);
            break;
    }
} catch (\PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erro de conexão com o banco de dados.', 'debug' => $e->getMessage()]);
} catch (\Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erro interno no servidor.', 'debug' => $e->getMessage()]);
}
