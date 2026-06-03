<?php

namespace App\Repositories;

use App\Model\Database;
use App\Model\Inscricao;
use PDO;

class InscricaoRepository implements IInscricaoRepository {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function save(Inscricao $inscricao): bool {
        if ($inscricao->id === null) {
            // Criação de registro no banco SQLite
            $sql = "INSERT INTO inscricoes (nome, email, curso) VALUES (:nome, :email, :curso)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':nome', $inscricao->nome);
            $stmt->bindValue(':email', $inscricao->email);
            $stmt->bindValue(':curso', $inscricao->curso);
            
            if ($stmt->execute()) {
                $inscricao->id = (int)$this->db->lastInsertId();
                return true;
            }
            return false;
        } else {
            // Atualização de registro existente
            $sql = "UPDATE inscricoes SET nome = :nome, email = :email, curso = :curso WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':nome', $inscricao->nome);
            $stmt->bindValue(':email', $inscricao->email);
            $stmt->bindValue(':curso', $inscricao->curso);
            $stmt->bindValue(':id', $inscricao->id);
            return $stmt->execute();
        }
    }

    public function find(int $id): ?Inscricao {
        $sql = "SELECT * FROM inscricoes WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $dados = $stmt->fetch();
        if (!$dados) {
            return null;
        }

        return new Inscricao($dados['nome'], $dados['email'], $dados['curso'], (int)$dados['id']);
    }

    public function delete(int $id): bool {
        $sql = "DELETE FROM inscricoes WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
}