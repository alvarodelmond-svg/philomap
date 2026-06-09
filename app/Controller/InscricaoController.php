<?php

namespace App\Controller;

use App\Services\InscricaoService;
use App\Model\Inscricao;
use App\Middleware\BusinessRuleException;

class InscricaoController {
    private InscricaoService $service;

    // O Controller também recebe sua dependência (o Service) via construtor
    public function __construct(InscricaoService $service) {
        $this->service = $service;
    }

    /**
     * Processa o formulário de cadastro de inscrição (POST)
     */
    public function store() {
        // Captura os dados vindos do formulário POST
        $nome = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $curso = $_POST['curso'] ?? '';

        // Cria a entidade simples
        $inscricao = new Inscricao($nome, $email, $curso);

        try {
            // Tenta executar a regra de negócio do Service
            $this->service->registrarInscricao($inscricao);

            // Se der sucesso, redireciona o usuário (Evita reenvio de formulário)
            header("Location: /inscricao/sucesso");
            exit;

        } catch (BusinessRuleException $e) {
            // Se capturar o erro da regra de negócio, define a mensagem e renderiza a view
            $errorMessage = $e->getMessage();
            
            // Carrega a view passando a variável com o erro
            require __DIR__ . '/../view/inscricao_form.php';
        }
    }
}