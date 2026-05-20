<?php

namespace App\Services;

use App\Repositories\IConteudoRepository;
use App\Models\Favorito;
use App\Exceptions\BusinessRuleException;

class ConteudoService {
    private $repository;

    public function __construct(IConteudoRepository $repository) {
        $this->repository = $repository;
    }

    public function favoritar(int $usuario_id, string $conteudo_id, string $titulo_conteudo): bool {
        if (empty($usuario_id) || empty($conteudo_id) || empty($titulo_conteudo)) {
            throw new BusinessRuleException("Dados incompletos para favoritar.");
        }

        $favorito = new Favorito($usuario_id, $conteudo_id, $titulo_conteudo);
        
        try {
            return $this->repository->save($favorito);
        } catch (\Exception $e) {
            throw new BusinessRuleException("Erro ao salvar favorito: " . $e->getMessage());
        }
    }

    public function listarFavoritos(int $usuario_id): array {
        if (empty($usuario_id)) {
            throw new BusinessRuleException("ID de usuário inválido.");
        }
        return $this->repository->findByUsuario($usuario_id);
    }

    public function removerFavorito(int $usuario_id, string $conteudo_id): bool {
        if (empty($usuario_id) || empty($conteudo_id)) {
            throw new BusinessRuleException("Dados incompletos para remover favorito.");
        }
        return $this->repository->delete($usuario_id, $conteudo_id);
    }
}
