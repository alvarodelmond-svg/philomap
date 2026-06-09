<?php

namespace App\Middleware;

class Middleware {
    /**
     * Sanitiza todas as entradas de dados via POST contra XSS.
     */
    public static function handleXSS(): array {
        $sanitized = [];
        foreach ($_POST as $key => $value) {
            // Aplica sanitização em cada campo do POST
            $sanitized[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        return $sanitized;
    }

    public static function validatePostRequest() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
            exit;
        }
    }
}
