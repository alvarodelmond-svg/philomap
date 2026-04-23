<?php
// Autoload simples para carregar as classes do namespace App
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/app/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) return;

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

use App\Core\Router;
use App\Middlewares\LoggerMiddleware;

// Inicializa o Router
$router = new Router();

// Define as Rotas e seus respectivos Middlewares
$router->get('/', 'MatriculaController@index', [LoggerMiddleware::class]);
$router->post('/store', 'MatriculaController@store', [LoggerMiddleware::class]);

// Executa a aplicação
$router->run();
