<?php
header('Content-Type: text/plain');
echo "Diagnóstico de Conexão PhiloMap (SQLite)\n";
echo "--------------------------------------\n";

$configFile = __DIR__ . '/config.ini';
if (!file_exists($configFile)) {
    die("ERRO: config.ini não encontrado!\n");
}

$configData = parse_ini_file($configFile, true, INI_SCANNER_TYPED);
$config = $configData['database'] ?? [];

if ($config['driver'] !== 'sqlite') {
    die("ERRO: Driver configurado não é sqlite. Atualize o config.ini para driver = sqlite.\n");
}

$dbPath = $config['path'] ?? 'database/philomap.sqlite';
$basePath = __DIR__;
$dbFile = $dbPath;

if (!preg_match('/^(?:[A-Za-z]:|\\\\|\/)/', $dbPath)) {
    $dbFile = $basePath . DIRECTORY_SEPARATOR . str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $dbPath);
}

echo "Arquivo do Banco: " . $dbFile . "\n";

try {
    $dsn = "sqlite:" . $dbFile;
    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "SUCESSO: Conectado ao banco SQLite.\n";
    
    $stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='matriculas'");
    if ($stmt->fetch()) {
        echo "SUCESSO: Tabela 'matriculas' encontrada.\n";
        
        $count = $pdo->query("SELECT COUNT(*) FROM matriculas")->fetchColumn();
        echo "Registros na tabela: " . $count . "\n";
    } else {
        echo "AVISO: Tabela 'matriculas' NÃO existe no arquivo SQLite.\n";
    }
} catch (PDOException $e) {
    echo "ERRO DE CONEXÃO: " . $e->getMessage() . "\n";
}
