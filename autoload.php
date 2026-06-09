<?php

spl_autoload_register(function ($class) {
    // Transforma o Namespace (ex: App\Controller\InscricaoController) no padrão de pastas
    $class = str_replace('\\', '/', $class);
    
    // Mapeia o prefixo 'App/' para a pasta real 'app/' (que está em minúsculo no sistema)
    if (strpos($class, 'App/') === 0) {
        $class = 'app' . substr($class, 3);
    }

    // Monta o caminho completo até o arquivo
    $file = __DIR__ . '/' . $class . '.php';

    // Se o arquivo físico existir na pasta, o PHP inclui ele automaticamente
    if (file_exists($file)) {
        require_once $file;
    }
});