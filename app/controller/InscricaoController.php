<?php

namespace App\Controller;

use App\Services\InscricaoService;
use App\Exceptions\BusinessRuleException;

class InscricaoController {
    private InscricaoService $service;

    public function __construct(InscricaoService $service) {
        $this->service = $service;
    }

    public function store(array $data) {
        try {
            $this->service->realizarInscricao($data);
            
            // Sucesso
            echo json_encode([
                'success' => true,
                'message' => 'Inscrição realizada com sucesso!'
            ]);

        } catch (BusinessRuleException $e) {
            // Erro de regra de negócio (esperado)
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        } catch (\Exception $e) {
            // Erro inesperado
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Ocorreu um erro interno no servidor.'
            ]);
        }
    }

    public function destroy(array $data) {
        try {
            $id = (int)($data['id'] ?? 0);
            $this->service->cancelarInscricao($id);

            echo json_encode([
                'success' => true,
                'message' => 'Inscrição removida com sucesso!'
            ]);

        } catch (BusinessRuleException $e) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
