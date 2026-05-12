<?php

class SanitizeMiddleware {
    public function handle() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            foreach ($_POST as $key => $value) {
                // Aplica sanitização básica em todos os campos do POST
                $_POST[$key] = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return true;
    }
}
