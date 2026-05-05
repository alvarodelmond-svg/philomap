<?php
class MatriculaRepository implements IMatriculaRepository {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function save(array $data) {
        $sql = "INSERT INTO matriculas (aluno, curso) VALUES (:aluno, :curso)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }
}