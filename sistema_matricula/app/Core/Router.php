<?php
namespace App\Core;

class Router {
    private $routes = [];
    private $middlewares = [];

    // Adiciona rota GET
    public function get($path, $handler, $middleware = []) {
        $this->routes['GET'][$path] = [
            'handler' => $handler,
            'middleware' => $middleware
        ];
    }

    // Adiciona rota POST
    public function post($path, $handler, $middleware = []) {
        $this->routes['POST'][$path] = [
            'handler' => $handler,
            'middleware' => $middleware
        ];
    }

    // Executa a rota atual
    public function run() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Ajuste para rodar em subpastas se necessário
        $path = str_replace('/sistema_matricula', '', $path);
        if ($path == '') $path = '/';

        if (!isset($this->routes[$method][$path])) {
            http_response_code(404);
            echo "<h1>404 - Rota não encontrada</h1>";
            return;
        }

        $route = $this->routes[$method][$path];
        
        // Executa Middlewares
        foreach ($route['middleware'] as $mwClass) {
            $mw = new $mwClass();
            if (!$mw->handle()) return; // Interrompe se o middleware retornar false
        }

        // Chama o Handler (Controller@metodo)
        list($controller, $action) = explode('@', $route['handler']);
        $controllerClass = "App\\Controllers\\" . $controller;
        
        $obj = new $controllerClass();
        $obj->$action();
    }
}
