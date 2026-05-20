<?php

namespace App\Controllers;

use App\Services\InscricaoService;
use App\Exceptions\BusinessRuleException;

class InscricaoController {
    private $service;

    public function __construct(InscricaoService $service) {
        $this->service = $service;
    }

    public function store(array $data) {
        try {
            $success = $this->service->realizarInscricao(
                (string)($data['nome'] ?? ''),
                (int)($data['idade'] ?? 0),
                (string)($data['estudo'] ?? '')
            );
            
            echo json_encode(['success' => true, 'message' => 'Inscrição realizada com sucesso!']);
        } catch (BusinessRuleException $e) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
