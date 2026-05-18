<?php
class MatriculaService {
    private $repo;
    private $validCourses = [
        'Engenharia de Software',
        'Ciência de Dados',
        'Arquitetura Digital',
        'Gestão de TI'
    ];

    public function __construct(IMatriculaRepository $repo) {
        $this->repo = $repo;
    }

    public function matricular(array $data) {
        $aluno = trim($data['aluno'] ?? '');
        $curso = trim($data['curso'] ?? '');
        $idade = $data['idade'] ?? null;

        if ($aluno === '') {
            throw new BusinessRuleException('Erro: O nome do aluno não pode ser vazio.');
        }

        if (mb_strlen($aluno) < 3) {
            throw new BusinessRuleException('Erro: O nome deve ter pelo menos 3 caracteres.');
        }

        if ($curso === '' || !in_array($curso, $this->validCourses, true)) {
            throw new BusinessRuleException('Erro: Selecione um curso válido.');
        }

        if (!filter_var($idade, FILTER_VALIDATE_INT, ['options' => ['min_range' => 16, 'max_range' => 100]])) {
            throw new BusinessRuleException('Erro: Informe uma idade válida entre 16 e 100 anos.');
        }

        return $this->repo->save([
            'aluno' => $aluno,
            'curso' => $curso,
            'idade' => (int) $idade
        ]);
    }
}
