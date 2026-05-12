<?php
class MatriculaRepository implements IMatriculaRepository {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function save(array $data) {
        $sql = "INSERT INTO matriculas (aluno, curso) VALUES (:aluno, :curso)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':aluno' => $data['aluno'],
            ':curso' => $data['curso']
        ]);
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