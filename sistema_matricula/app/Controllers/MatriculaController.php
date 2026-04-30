<?php
namespace App\Controllers;

class MatriculaController {
    
    public function index() {
        $exibirResumo = false;
        require __DIR__ . '/../../views/form.php';
    }

    public function store() {
        // Define o cabeçalho para JSON
        header('Content-Type: application/json');

        $nome = htmlspecialchars($_POST['nome'] ?? '');
        $idade = intval($_POST['idade'] ?? 0);
        $curso = htmlspecialchars($_POST['curso'] ?? '');
        $dataMatricula = date("d/m/Y H:i");

        if (!empty($nome) && $idade >= 16 && !empty($curso)) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Matrícula realizada com sucesso!',
                'data' => [
                    'nome' => $nome,
                    'idade' => $idade,
                    'curso' => $curso,
                    'data' => $dataMatricula,
                    'protocolo' => strtoupper(uniqid('MAT-'))
                ]
            ]);
        } else {
            http_response_code(400);
            echo json_encode([
                'status' => 'error',
                'message' => 'Erro: Verifique se todos os campos estão preenchidos corretamente (Idade mínima: 16 anos).'
            ]);
        }
    }
}
