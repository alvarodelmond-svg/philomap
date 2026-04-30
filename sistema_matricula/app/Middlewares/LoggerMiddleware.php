<?php
namespace App\Middlewares;

class LoggerMiddleware {
    public function handle() {
        // Exemplo: Registrar no log de acesso
        // error_log("Acessando página de matrícula em " . date('Y-m-d H:i:s'));
        return true; // Se retornar false, a rota é interrompida
    }
}
