<?php

namespace App\Repositories;

use App\Models\Favorito;

interface IConteudoRepository {
    public function save(Favorito $favorito): bool;
    public function findByUsuario(int $usuario_id): array;
    public function delete(int $usuario_id, string $conteudo_id): bool;
}
