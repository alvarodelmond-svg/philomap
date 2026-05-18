<?php

$configFile = __DIR__ . '/../../config.ini';
if (!file_exists($configFile)) {
    die('Arquivo config.ini não encontrado. Copie o arquivo de exemplo e ajuste o caminho do banco SQLite.');
}

$config = parse_ini_file($configFile, true, INI_SCANNER_TYPED);
if ($config === false || !empty($config['database']['driver']) && $config['database']['driver'] !== 'sqlite') {
    die('Configuração inválida ou driver diferente de sqlite em config.ini.');
}

$dbPath = $config['database']['path'] ?? null;
if (!$dbPath) {
    die('A chave database.path não foi encontrada no config.ini.');
}

$basePath = realpath(__DIR__ . '/../../');
$dbFile = $dbPath;
if (!preg_match('/^(?:[A-Za-z]:|\\\\|\/)/', $dbPath)) {
    $dbFile = $basePath . DIRECTORY_SEPARATOR . str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $dbPath);
}

$dir = dirname($dbFile);
if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}

$pdo = new PDO('sqlite:' . $dbFile);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pdo->exec(
    "CREATE TABLE IF NOT EXISTS matriculas (" .
    "id INTEGER PRIMARY KEY AUTOINCREMENT, " .
    "aluno TEXT NOT NULL, " .
    "idade INTEGER NOT NULL, " .
    "curso TEXT NOT NULL, " .
    "created_at TEXT NOT NULL" .
    ")"
);

echo "Banco SQLite pronto em: $dbFile\n";
