<?php

namespace App\Router;

/**
 * Classe Router - Gerencia o roteamento entre páginas HTML e ações da API.
 */
class Router {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Ponto de entrada para processar a requisição.
     */
    public function handleRequest() {
        $pagina = $_GET['url'] ?? '';

        // 1. Roteamento de Páginas (Views)
        if ($this->isViewRoute($pagina)) {
            $this->renderView($pagina);
            return;
        }

        // 2. Roteamento de Ações (API/Ajax)
        $this->handleApiActions();
    }

    /**
     * Define quais URLs correspondem a arquivos HTML.
     */
    private function isViewRoute($pagina) {
        $viewRoutes = ['', 'login', 'dashboard'];
        return in_array($pagina, $viewRoutes);
    }

    /**
     * Carrega a interface visual solicitada.
     */
    private function renderView($pagina) {
        if ($pagina === 'login' || $pagina === '') {
            // Atualizado de /view/ para /html/
            require_once BASE_DIR . '/html/login.html';
            exit;
        } elseif ($pagina === 'dashboard') {
            require_once BASE_DIR . '/index.html';
            exit;
        }
    }

    /**
     * Processa ações de banco de dados via parâmetros da URL.
     */
    private function handleApiActions() {
        header('Content-Type: application/json');
        $action = $_GET['action'] ?? '';

        try {
            switch ($action) {
                case 'favoritar':
                    \App\Middleware\Middleware::validatePostRequest();
                    $data = \App\Middleware\Middleware::sanitizeInput($_POST);
                    $this->dispatch('ConteudoController', 'store', $data);
                    break;

                case 'listar':
                    $usuario_id = (int)($_GET['usuario_id'] ?? 0);
                    $this->dispatch('ConteudoController', 'index', $usuario_id);
                    break;

                case 'remover':
                    \App\Middleware\Middleware::validatePostRequest();
                    $data = \App\Middleware\Middleware::sanitizeInput($_POST);
                    $this->dispatch('ConteudoController', 'destroy', $data);
                    break;

                case 'inscrever':
                    \App\Middleware\Middleware::validatePostRequest();
                    $data = \App\Middleware\Middleware::sanitizeInput($_POST);
                    $this->dispatch('InscricaoController', 'store', $data);
                    break;

                default:
                    http_response_code(404);
                    echo json_encode(['success' => false, 'message' => 'Rota ou ação não encontrada.']);
                    break;
            }
        } catch (\PDOException $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Erro no banco de dados.', 'debug' => $e->getMessage()]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Erro interno no servidor.', 'debug' => $e->getMessage()]);
        }
    }

    /**
     * Tenta instanciar o Controller e chamar o método, se existirem.
     */
    private function dispatch($controllerName, $method, $data) {
        $fullClass = "\\App\\Controller\\" . $controllerName;
        
        if (!class_exists($fullClass)) {
            throw new \Exception("A classe $controllerName não foi encontrada pelo sistema.");
        }

        // Nota: Os Controllers e Services precisam ser criados para que isso funcione 100%
        if ($controllerName === 'InscricaoController') {
            $repo = new \App\Repositories\InscricaoRepository($this->db);
            $service = class_exists("\\App\\Services\\InscricaoService") ? new \App\Services\InscricaoService($repo) : null;
            $controller = new $fullClass($service);
        } else {
            $controller = new $fullClass($this->db);
        }

        if (method_exists($controller, $method)) {
            $controller->$method($data);
        } else {
            throw new \Exception("O método $method não existe no controller $controllerName.");
        }
    }
}
