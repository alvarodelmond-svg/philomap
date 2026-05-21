<?php

namespace App\Middleware;

class Middleware {
    public static function sanitizeInput(array $data): array {
        $sanitized = [];
        foreach ($data as $key => $value) {
            $sanitized[$key] = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        return $sanitized;
    }

    public static function validatePostRequest() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
            exit;
        }
    }
}
