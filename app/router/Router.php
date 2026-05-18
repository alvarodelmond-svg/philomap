<?php
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
        
        // Ajuste para caminhos vazios ou se estiver rodando em subpasta
        if (!$path) $path = '/';

        if (!isset($this->routes[$method][$path])) {
            // Tenta remover index.php do path se necessário
            $path = str_replace('/index.php', '', $path);
            if ($path === '') $path = '/';
            
            if (!isset($this->routes[$method][$path])) {
                http_response_code(404);
                echo "<h1>404 - Rota não encontrada ($method $path)</h1>";
                return;
            }
        }

        $route = $this->routes[$method][$path];
        $handler = $route['handler'];
        
        // Executa Middlewares
        foreach ($route['middleware'] as $mwClass) {
            $mw = new $mwClass();
            if (method_exists($mw, 'handle')) {
                $mw->handle();
            }
        }

        // Verifica se o handler é uma função/closure
        if (is_callable($handler)) {
            call_user_func($handler);
        } else if (is_string($handler) && strpos($handler, '@') !== false) {
            // Mantém suporte para Controller@method se necessário no futuro
            list($controller, $action) = explode('@', $handler);
            $obj = new $controller();
            $obj->$action();
        } else {
            throw new Exception("Handler de rota inválido.");
        }
    }
}
