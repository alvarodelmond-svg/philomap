<?php
// 1. Importa as classes (ajuste os caminhos se necessário)
require_once 'app/Database.php';
require_once 'app/appRepository/IMatriculaRepository.php';
require_once 'app/appRepository/MatriculaRepository.php';
require_once 'app/appService/BusinessRuleException.php';
require_once 'app/appService/MatriculaService.php';
require_once 'app/Controllers/MatriculaController.php';

// 2. MONTAGEM (Injeção de Dependência de baixo para cima)
$db = Database::getConnection(); // Passo 1
$repository = new MatriculaRepository($db); // Passo 2
$service = new MatriculaService($repository); // Passo 3
$controller = new MatriculaController($service); // Passo 4

// 3. Simulação de captura do formulário (Passo 5 - Sanitização)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = [
        // Suporta tanto 'aluno' (interno) quanto 'nome' (frontend PhiloMap)
        'aluno' => filter_input(INPUT_POST, 'aluno', FILTER_SANITIZE_SPECIAL_CHARS) ?: filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS),
        'curso' => filter_input(INPUT_POST, 'curso', FILTER_SANITIZE_SPECIAL_CHARS)
    ];
    
    $controller->store($dados);
} else {
    // Se não for POST, apenas mostra o formulário
    include 'views/form.php';
}
