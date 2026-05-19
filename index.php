<?php
require_once __DIR__ . '/autoload.php';

try {
    // Inicialização de Dependências
    $db = Database::getConnection();
    $repository = new MatriculaRepository($db);
    $service = new MatriculaService($repository);
    $controller = new MatriculaController($service);

    $router = new Router();

    // Rota GET - Redireciona para a página inicial
    $router->get('/', function() {
        header('Location: html/index.php');
        exit;
    });

    // Rota POST - Processa a matrícula
    $router->post('/', function() use ($controller) {
        $controller->store($_POST);
    });

    // Rota para suportar o fetch direto para index.php
    $router->post('/index.php', function() use ($controller) {
        $controller->store($_POST);
    });

    $router->run();

} catch (Throwable $e) {
    http_response_code(500);
    echo "<h1>Erro Fatal</h1>";
    echo "<p>" . $e->getMessage() . "</p>";
}
