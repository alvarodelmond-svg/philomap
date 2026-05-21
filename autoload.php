<?php
// autoload.php
spl_autoload_register(function ($className) {
    // Remove o namespace global 'App\'
    $className = str_replace('App\\', '', $className);
    $className = str_replace('\\', '/', $className);

    // Mapeamento de namespaces para pastas físicas (para resolver inconsistências)
    $map = [
        'Models' => 'model',
        'Services' => 'services',
        'Middleware' => 'middleware',
        'Router' => 'router'
    ];

    $parts = explode('/', $className);
    if (isset($map[$parts[0]])) {
        $parts[0] = $map[$parts[0]];
    }
    $pathName = implode('/', $parts);

    // Lista de diretórios base para busca
    $baseDir = __DIR__ . '/app/';
    
    // 1. Tenta encontrar diretamente na pasta app/
    $file = $baseDir . $pathName . '.php';
    if (file_exists($file)) {
        require_once $file;
        return;
    }

    // 2. Fallback para busca em subpastas específicas (legado)
    $directories = [
        'controller/',
        'model/',
        'middleware/',
        'services/',
        'router/',
        'Database/',
        'Repositories/',
        'Exceptions/'
    ];

    foreach ($directories as $dir) {
        $file = $baseDir . $dir . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});