<?php

namespace App\Services;

use App\Repositories\IInscricaoRepository;
use App\Model\Inscricao;
use App\Middleware\BusinessRuleException;

class InscricaoService {
    private IInscricaoRepository $repository;

    // Regra de Ouro: Recebe a INTERFACE por parâmetro, e não a classe concreta
    public function __construct(IInscricaoRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * Regra de negócio para criar ou atualizar uma inscrição.
     */
    public function registrarInscricao(Inscricao $inscricao): bool {
        // Validação simples de Regra de Negócio
        if (empty($inscricao->nome) || empty($inscricao->email) || empty($inscricao->curso)) {
            throw new BusinessRuleException("Todos os campos (Nome, E-mail e Curso) são obrigatórios para realizar a inscrição.");
        }

        if (!filter_var($inscricao->email, FILTER_VALIDATE_EMAIL)) {
            throw new BusinessRuleException("O endereço de e-mail informado não é válido.");
        }

        // Se passar nas regras, o repositório salva no banco SQLite
        return $this->repository->save($inscricao);
    }

    /**
     * Busca uma inscrição existente.
     */
    public function buscarPorId(int $id): ?Inscricao {
        $inscricao = $this->repository->find($id);
        if (!$inscricao) {
            throw new BusinessRuleException("A inscrição com o ID {$id} não foi encontrada no sistema.");
        }
        return $inscricao;
    }

    /**
     * Remove uma inscrição.
     */
    public function removerInscricao(int $id): bool {
        // Poderia ter uma regra aqui (ex: não deletar se o curso já começou)
        return $this->repository->delete($id);
    }
}