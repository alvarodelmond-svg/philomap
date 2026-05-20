<?php

namespace App\Controllers;

use App\Services\ConteudoService;
use App\Exceptions\BusinessRuleException;

class ConteudoController {
    private $service;

    public function __construct(ConteudoService $service) {
        $this->service = $service;
    }

    public function store(array $data) {
        try {
            $success = $this->service->favoritar(
                (int)($data['usuario_id'] ?? 0),
                (string)($data['conteudo_id'] ?? ''),
                (string)($data['titulo_conteudo'] ?? '')
            );
            
            echo json_encode(['success' => true, 'message' => 'Favoritado com sucesso!']);
        } catch (BusinessRuleException $e) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function index(int $usuario_id) {
        try {
            $favoritos = $this->service->listarFavoritos($usuario_id);
            $result = array_map(fn($f) => $f->toArray(), $favoritos);
            echo json_encode(['success' => true, 'data' => $result]);
        } catch (BusinessRuleException $e) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function destroy(array $data) {
        try {
            $success = $this->service->removerFavorito(
                (int)($data['usuario_id'] ?? 0),
                (string)($data['conteudo_id'] ?? '')
            );
            echo json_encode(['success' => true, 'message' => 'Removido dos favoritos!']);
        } catch (BusinessRuleException $e) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
