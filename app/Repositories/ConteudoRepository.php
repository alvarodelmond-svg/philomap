<?php

namespace App\Repositories;

use App\Models\Favorito;
use PDO;

class ConteudoRepository implements IConteudoRepository {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function save(Favorito $favorito): bool {
        $sql = "INSERT INTO favoritos (usuario_id, conteudo_id, titulo_conteudo) VALUES (:usuario_id, :conteudo_id, :titulo_conteudo)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':usuario_id' => $favorito->usuario_id,
            ':conteudo_id' => $favorito->conteudo_id,
            ':titulo_conteudo' => $favorito->titulo_conteudo
        ]);
    }

    public function findByUsuario(int $usuario_id): array {
        $sql = "SELECT * FROM favoritos WHERE usuario_id = :usuario_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':usuario_id' => $usuario_id]);
        
        $results = [];
        while ($row = $stmt->fetch()) {
            $results[] = new Favorito(
                $row['usuario_id'],
                $row['conteudo_id'],
                $row['titulo_conteudo'],
                $row['id'],
                $row['data_favorito']
            );
        }
        return $results;
    }

    public function delete(int $usuario_id, string $conteudo_id): bool {
        $sql = "DELETE FROM favoritos WHERE usuario_id = :usuario_id AND conteudo_id = :conteudo_id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':usuario_id' => $usuario_id,
            ':conteudo_id' => $conteudo_id
        ]);
    }
}
