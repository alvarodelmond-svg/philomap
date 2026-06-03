<?php

// 1. Carrega os autoloaders do projeto (garantindo que as classes sejam achadas)
require_once __DIR__ . '/autoload.php'; 
require_once __DIR__ . '/config.php';

use App\Repositories\InscricaoRepository;
use App\Services\InscricaoService;
use App\Controller\InscricaoController;

// Obtém o método HTTP e a URL atual da requisição
$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// ----------------------------------------------------------------------
// CONTAINER DE INJEÇÃO DE DEPENDÊNCIA (A montagem dos motores do sistema)
// ----------------------------------------------------------------------
// O Repositório abre a conexão via Singleton automaticamente no construtor
$inscricaoRepository = new InscricaoRepository();

// Injeta o Repositório dentro do Service
$inscricaoService = new InscricaoService($inscricaoRepository);

// Injeta o Service dentro do Controller
$inscricaoController = new InscricaoController($inscricaoService);
// ----------------------------------------------------------------------

// 2. SISTEMA DE ROTAS SIMPLIFICADO
// Rota para exibir o formulário de inscrição
if ($uri === '/inscricao' && $method === 'GET') {
    require __DIR__ . '/app/view/inscricao_form.php'; // Altere para o seu arquivo real se necessário
    exit;
}

// Rota POST: Onde o usuário envia os dados do formulário
if ($uri === '/inscricao/salvar' && $method === 'POST') {
    
    // --- SANITIZAÇÃO CONTRA XSS (Exigência extra do Passo 5) ---
    // Limpa tags HTML maliciosas antes que elas cheguem no Controller
    $_POST['nome']  = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $_POST['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $_POST['curso'] = filter_input(INPUT_POST, 'curso', FILTER_SANITIZE_SPECIAL_CHARS);
    
    // Dispara a execução no Controller já montado com suas dependências
    $inscricaoController->store();
    exit;
}

// Rota de Sucesso após o redirecionamento
if ($uri === '/inscricao/sucesso' && $method === 'GET') {
    echo "<h2>Inscrição realizada com sucesso no PhiloMap!</h2>";
    echo "<a href='/inscricao'>Voltar ao formulário</a>";
    exit;
}

// Caso não encontre nenhuma rota
http_response_code(404);
echo "Página não encontrada (404) - PhiloMap Framework.";