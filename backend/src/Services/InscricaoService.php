<?php

namespace App\Services;

use App\Repositories\IInscricaoRepository;
use App\Models\Inscricao;
use App\Exceptions\BusinessRuleException;

class InscricaoService {
    private $repository;

    public function __construct(IInscricaoRepository $repository) {
        $this->repository = $repository;
    }

    public function realizarInscricao(string $nome, int $idade, string $estudo): bool {
        if (empty($nome) || $idade <= 0 || empty($estudo)) {
            throw new BusinessRuleException("Dados de inscrição inválidos.");
        }

        $inscricao = new Inscricao($nome, $idade, $estudo);
        
        try {
            return $this->repository->save($inscricao);
        } catch (\Exception $e) {
            throw new BusinessRuleException("Erro ao processar inscrição no banco.");
        }
    }
}
