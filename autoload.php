<?php
spl_autoload_register(function ($className) {
    $baseDir = __DIR__ . '/app/';

    $paths = [
        'Controller' => 'controller/',
        'Repository' => 'model/',
        'Service' => 'services/',
        'Middleware' => 'middleware/',
        'Router' => 'router/',
        '' => '' // for Database or others in app/
    ];

    foreach ($paths as $suffix => $dir) {
        $file = $baseDir . $dir . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
?>
