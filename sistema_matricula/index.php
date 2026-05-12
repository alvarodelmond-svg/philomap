<?php
// 1. Importa as classes (ajuste os caminhos se necessário)
require_once 'app/Database.php';
require_once 'app/appRepository/IMatriculaRepository.php';
require_once 'app/appRepository/MatriculaRepository.php';
require_once 'app/appService/BusinessRuleException.php';
require_once 'app/appService/MatriculaService.php';
require_once 'app/Controllers/MatriculaController.php';
require_once 'app/Middlewares/SanitizeMiddleware.php';

// 2. MIDDLEWARE (Segurança e Sanitização - Passo 5)
$sanitize = new SanitizeMiddleware();
$sanitize->handle();

// 3. MONTAGEM / CONTAINER DE DI (Passo 5)
$db = Database::getConnection(); 
$repository = new MatriculaRepository($db);
$service = new MatriculaService($repository);
$controller = new MatriculaController($service);

// 4. ROTEAMENTO SIMPLIFICADO
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = [
        'aluno' => $_POST['nome'] ?? $_POST['aluno'] ?? '',
        'curso' => $_POST['curso'] ?? ''
    ];
    $controller->store($dados);
} else {
    // Se não for POST, apenas mostra o formulário
    include 'views/form.php';
}
