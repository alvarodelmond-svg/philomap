<?php

namespace App\Services;

use App\Repositories\IInscricaoRepository;
use App\Models\Inscricao;
use App\Exceptions\BusinessRuleException;

class InscricaoService {
    private IInscricaoRepository $repository;

    public function __construct(IInscricaoRepository $repository) {
        $this->repository = $repository;
    }

    public function realizarInscricao(array $data): bool {
        // Regras de negócio
        if (empty($data['nome']) || empty($data['idade']) || empty($data['estudo'])) {
            throw new BusinessRuleException("Todos os campos são obrigatórios.");
        }

        if ($data['idade'] < 12) {
            throw new BusinessRuleException("A idade mínima para inscrição é 12 anos.");
        }

        $inscricao = new Inscricao(
            $data['nome'],
            (int)$data['idade'],
            $data['estudo']
        );

        if (!$this->repository->save($inscricao)) {
            throw new BusinessRuleException("Erro ao salvar a inscrição no banco de dados.");
        }

        return true;
    }

    public function buscarInscricao(int $id): ?Inscricao {
        return $this->repository->find($id);
    }

    public function cancelarInscricao(int $id): bool {
        if (!$this->repository->delete($id)) {
            throw new BusinessRuleException("Erro ao remover a inscrição.");
        }
        return true;
    }
}
