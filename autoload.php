<?php

spl_autoload_register(function ($class) {
    // Transforma o Namespace (ex: App\Controller\InscricaoController) no padrão de pastas do Windows/Linux
    // Substitui as barras invertidas (\) por barras normais (/)
    $class = str_replace('\\', '/', $class);
    
    // Converte a primeira letra "App" para minúsculo "app", para bater certinho com o nome da sua pasta
    $class = lcfirst($class);

    // Monta o caminho completo até o arquivo
    $file = __DIR__ . '/' . $class . '.php';

    // Se o arquivo físico existir na pasta, o PHP inclui ele automaticamente
    if (file_exists($file)) {
        require_once $file;
    }
});