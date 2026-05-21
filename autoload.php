<?php
// autoload.php
spl_autoload_register(function ($className) {
    // Remove o namespace global se houver (ex: App\)
    $className = str_replace('App\\', '', $className);
    $className = str_replace('\\', '/', $className);

    $directories = [
        __DIR__ . '/app/controller/',
        __DIR__ . '/app/model/',
        __DIR__ . '/app/middleware/',
        __DIR__ . '/app/services/',
        __DIR__ . '/app/router/'
    ];

    foreach ($directories as $directory) {
        $file = $directory . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});