<?php
// index.php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/autoload.php';

session_start();

// 1. Roteamento de Páginas Visuais (HTML/Interface)
$pagina = $_GET['url'] ?? '';

if ($pagina === 'login') {
    require_once __DIR__ . '/view/login.html';
    exit;
} elseif ($pagina === 'dashboard') {
    require_once __DIR__ . '/view/index.html';
    exit;
}

// 2. Roteamento de Ações do Sistema (Processamento de Formulários/API)
header('Content-Type: application/json');

try {
    // Abre a conexão com o banco via Singleton
    $db = \App\Database\Database::getInstance()->getConnection();
    $action = $_GET['action'] ?? '';

    switch ($action) {
        case 'favoritar':
            \App\Middleware\Middleware::validatePostRequest();
            $data = \App\Middleware\Middleware::sanitizeInput($_POST);
            $controller = new ConteudoController(new ConteudoService(new ConteudoRepository($db)));
            $controller->store($data);
            break;

        case 'listar':
            $usuario_id = (int)($_GET['usuario_id'] ?? 0);
            $controller = new ConteudoController(new ConteudoService(new ConteudoRepository($db)));
            $controller->index($usuario_id);
            break;

        case 'remover':
            \App\Middleware\Middleware::validatePostRequest();
            $data = \App\Middleware\Middleware::sanitizeInput($_POST);
            $controller = new ConteudoController(new ConteudoService(new ConteudoRepository($db)));
            $controller->destroy($data);
            break;

        case 'inscrever':
            \App\Middleware\Middleware::validatePostRequest();
            $data = \App\Middleware\Middleware::sanitizeInput($_POST);
            $controller = new InscricaoController(new InscricaoService(new InscricaoRepository($db)));
            $controller->store($data);
            break;

        default:
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Rota ou ação não encontrada.']);
            break;
    }

} catch (\PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erro de conexão com o banco de dados.', 'debug' => $e->getMessage()]);
} catch (\Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erro interno no servidor.', 'debug' => $e->getMessage()]);
}