<?php

namespace App\Repositories;

use App\Models\Inscricao;
use PDO;

class InscricaoRepository implements IInscricaoRepository {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function save(Inscricao $inscricao): bool {
        $sql = "INSERT INTO inscricoes (nome, idade, estudo) VALUES (:nome, :idade, :estudo)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nome' => $inscricao->nome,
            ':idade' => $inscricao->idade,
            ':estudo' => $inscricao->estudo
        ]);
    }
}
