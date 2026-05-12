<?php
header('Content-Type: text/plain');
echo "Diagnóstico de Conexão PhiloMap\n";
echo "------------------------------\n";

$configFile = __DIR__ . '/sistema_matricula/config.ini';
if (!file_exists($configFile)) {
    die("ERRO: config.ini não encontrado!\n");
}

$config = parse_ini_file($configFile);
echo "Host: " . $config['host'] . "\n";
echo "DB: " . $config['dbname'] . "\n";
echo "User: " . $config['user'] . "\n";

try {
    $dsn = "mysql:host={$config['host']};charset=utf8";
    $pdo = new PDO($dsn, $config['user'], $config['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    echo "SUCESSO: Conectado ao Servidor MySQL.\n";
    
    $stmt = $pdo->query("SHOW DATABASES LIKE '{$config['dbname']}'");
    if ($stmt->fetch()) {
        echo "SUCESSO: Banco de dados '{$config['dbname']}' encontrado.\n";
        $pdo->query("USE `{$config['dbname']}`");
        
        $stmt = $pdo->query("SHOW TABLES LIKE 'matriculas'");
        if ($stmt->fetch()) {
            echo "SUCESSO: Tabela 'matriculas' encontrada.\n";
        } else {
            echo "AVISO: Tabela 'matriculas' NÃO existe. Criando...\n";
            $pdo->exec("CREATE TABLE IF NOT EXISTS matriculas (
                id INT AUTO_INCREMENT PRIMARY KEY,
                aluno VARCHAR(255) NOT NULL,
                curso VARCHAR(255) NOT NULL,
                data_inscricao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )");
            echo "SUCESSO: Tabela 'matriculas' criada.\n";
        }
    } else {
        echo "ERRO: Banco de dados '{$config['dbname']}' NÃO existe.\n";
        echo "DICA: No PHPMyAdmin, crie um banco chamado '{$config['dbname']}'.\n";
    }
} catch (PDOException $e) {
    echo "ERRO DE CONEXÃO: " . $e->getMessage() . "\n";
    if (strpos($e->getMessage(), 'Connection refused') !== false) {
        echo "DICA: O MySQL está desligado! Ligue o MySQL no XAMPP/WAMP ou no terminal.\n";
    }
}
