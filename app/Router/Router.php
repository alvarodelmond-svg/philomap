<?php

namespace App\Router;

/**
 * Classe Router - Gerencia o roteamento simplificado.
 */
class Router {
    private $inscricaoController;

    public function __construct($inscricaoController) {
        $this->inscricaoController = $inscricaoController;
    }

    public function handleRequest() {
        $pagina = $_GET['url'] ?? '';

        // 1. Roteamento de Páginas (Views)
        if ($this->isViewRoute($pagina)) {
            $this->renderView($pagina);
            return;
        }

        // 2. Ações de API
        $this->handleApiActions();
    }

    private function isViewRoute($pagina) {
        $viewRoutes = ['', 'login', 'dashboard', 'inscricao'];
        return in_array($pagina, $viewRoutes);
    }

    private function renderView($pagina) {
        $basePath = __DIR__ . '/../../view/';
        
        switch ($pagina) {
            case 'login':
            case '':
                require_once $basePath . 'login.html';
                break;
            case 'dashboard':
                require_once __DIR__ . '/../../index.html';
                break;
            case 'inscricao':
                require_once $basePath . 'inscricao.html';
                break;
            default:
                require_once $basePath . 'error.html';
                break;
        }
        exit;
    }

    private function handleApiActions() {
        header('Content-Type: application/json');
        $action = $_GET['action'] ?? '';

        switch ($action) {
            case 'inscrever':
                \App\Middleware\Middleware::validatePostRequest();
                $data = \App\Middleware\Middleware::handleXSS();
                $this->inscricaoController->store($data);
                break;

            case 'cancelar-inscricao':
                \App\Middleware\Middleware::validatePostRequest();
                $data = \App\Middleware\Middleware::handleXSS();
                $this->inscricaoController->destroy($data);
                break;

            default:
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'Ação não encontrada.']);
                break;
        }
    }
}
