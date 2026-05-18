<?php
class MatriculaRepository implements IMatriculaRepository {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function save(array $data) {
        $sql = "INSERT INTO matriculas (aluno, idade, curso, created_at) VALUES (:aluno, :idade, :curso, :created_at)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':aluno' => $data['aluno'],
            ':idade' => $data['idade'],
            ':curso' => $data['curso'],
            ':created_at' => date('Y-m-d H:i:s')
        ]);
        return $this->db->lastInsertId();
    }

    public function find($id) {
        $sql = "SELECT * FROM matriculas WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $sql = "DELETE FROM matriculas WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
