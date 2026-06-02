<?php

/**
 * Autoload.php - Registro do spl_autoload_register para carregamento automático de classes.
 */
spl_autoload_register(function ($className) {
    // Prefix do namespace do projeto
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/app/';

    // Verifica se a classe usa o prefixo do namespace
    $len = strlen($prefix);
    if (strncmp($prefix, $className, $len) !== 0) {
        return;
    }

    // Obtém o nome relativo da classe
    $relativeClass = substr($className, $len);

    // Mapeamento de Namespaces para Pastas (Garantindo compatibilidade com nomes minúsculos/maiúsculos)
    $map = [
        'Controller' => 'controller',
        'Models'     => 'model',
        'Services'   => 'services',
        'Middleware' => 'middleware',
        'Router'     => 'router'
    ];

    $parts = explode('\\', $relativeClass);
    if (isset($map[$parts[0]])) {
        $parts[0] = $map[$parts[0]];
    }

    $file = $baseDir . implode('/', $parts) . '.php';

    if (file_exists($file)) {
        require_once $file;
    } else {
        // Fallback genérico para outras subpastas em app/
        $fileGeneric = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
        if (file_exists($fileGeneric)) {
            require_once $fileGeneric;
        }
    }
});
