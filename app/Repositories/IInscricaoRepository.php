<?php

namespace App\Repositories;

use App\Models\Inscricao;

interface IInscricaoRepository {
    public function save(Inscricao $inscricao): bool;
    public function find(int $id): ?Inscricao;
    public function delete(int $id): bool;
}
