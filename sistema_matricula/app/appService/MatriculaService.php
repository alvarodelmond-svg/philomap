<?php
class MatriculaService {
    private $repo;

    // Aqui o Service recebe o Repositório pronto (Passo 3 da atividade)
    public function __construct(IMatriculaRepository $repo) {
        $this->repo = $repo;
    }

    public function matricular(array $data) {
        if (empty($data['aluno'])) {
            throw new BusinessRuleException("Erro: O nome do aluno não pode ser vazio!");
        }
        return $this->repo->save($data);
    }
}