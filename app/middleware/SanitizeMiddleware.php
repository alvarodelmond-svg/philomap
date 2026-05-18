<?php

class SanitizeMiddleware {
    public function handle() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $clean = [];
            foreach ($_POST as $key => $value) {
                $cleanValue = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                $clean[$key] = $cleanValue !== null ? $cleanValue : '';
            }
            $_POST = $clean;
        }
        return true;
    }
}
