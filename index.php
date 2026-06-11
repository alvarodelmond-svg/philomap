<?php

// Habilitar erros para diagnóstico (pode remover depois)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 0. Se o arquivo existir no disco (CSS, JS, imagens), o PHP serve direto
if (php_sapi_name() === 'cli-server') {
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $file = __DIR__ . $path;

    // 1. Tenta encontrar o arquivo no caminho direto (raiz)
    if (file_exists($file) && is_file($file)) {
        return false;
    }

    // 2. Se não achou na raiz, tenta procurar dentro de app/view/
    $viewPath = __DIR__ . '/app/view' . $path;
    if (file_exists($viewPath) && is_file($viewPath)) {
        $ext = pathinfo($viewPath, PATHINFO_EXTENSION);
        if ($ext === 'css') header('Content-Type: text/css');
        if ($ext === 'js') header('Content-Type: application/javascript');
        if ($ext === 'svg') header('Content-Type: image/svg+xml');
        readfile($viewPath);
        return true;
    }
}

// 1. Carrega os autoloaders e configs
require_once __DIR__ . '/autoload.php'; 
require_once __DIR__ . '/config.php';

use App\Repositories\InscricaoRepository;
use App\Services\InscricaoService;
use App\Controller\InscricaoController;

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Injeção de Dependência
$inscricaoRepository = new InscricaoRepository();
$inscricaoService = new InscricaoService($inscricaoRepository);
$inscricaoController = new InscricaoController($inscricaoService);

// 2. SISTEMA DE ROTAS DINÂMICO

// Rota para a página inicial
if ($uri === '/' || $uri === '/index.html') {
    require __DIR__ . '/app/view/index.html'; 
    exit;
}

// Rota específica para inscrição (GET e POST)
if ($uri === '/inscricao') {
    require __DIR__ . '/app/view/inscricao.html'; 
    exit;
}

if ($uri === '/inscricao/salvar' && $method === 'POST') {
    $_POST['nome']  = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $_POST['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $_POST['curso'] = filter_input(INPUT_POST, 'curso', FILTER_SANITIZE_SPECIAL_CHARS);
    $inscricaoController->store();
    exit;
}

if ($uri === '/inscricao/sucesso') {
    echo "<h2>Inscrição realizada com sucesso no PhiloMap!</h2>";
    echo "<a href='/'>Voltar ao início</a>";
    exit;
}

// Tenta encontrar o arquivo correspondente na pasta app/view
$viewFile = __DIR__ . '/app/view' . $uri;
if (file_exists($viewFile) && is_file($viewFile)) {
    require $viewFile;
    exit;
}

// Tenta encontrar sem a extensão .html
$viewFileWithExt = __DIR__ . '/app/view' . $uri . '.html';
if (file_exists($viewFileWithExt) && is_file($viewFileWithExt)) {
    require $viewFileWithExt;
    exit;
}

// Caso não encontre nenhuma rota
http_response_code(404);
echo "Página não encontrada (404) - PhiloMap Framework.";
