<?php

namespace App\Repositories;

use App\Models\Inscricao;

interface IInscricaoRepository {
    public function save(Inscricao $inscricao): bool;
}
