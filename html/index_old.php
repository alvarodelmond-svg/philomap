<?php
try {
    require_once 'config.php';
    require_once 'autoload.php';

    $sanitize = new SanitizeMiddleware();
    $sanitize->handle();

    $db = Database::getConnection();
    $repository = new MatriculaRepository($db);
    $service = new MatriculaService($repository);
    $controller = new MatriculaController($service);

    $router = new Router();
    $router->get('/', function () {
        include 'view/form.php';
    });
    $router->get('/index.php', function () {
        include 'view/form.php';
    });
    $router->post('/register', function () use ($controller) {
        $dados = [
            'nome' => $_POST['nome'] ?? '',
            'idade' => $_POST['idade'] ?? '',
            'curso' => $_POST['curso'] ?? ''
        ];
        $controller->store($dados);
    });

    $router->run();
} catch (Throwable $e) {
    $message = $e->getMessage();
    include 'view/error.php';
}
?>
