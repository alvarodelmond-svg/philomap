<?php
$configFile = __DIR__ . '/config.ini';
if (!file_exists($configFile)) {
    throw new RuntimeException('Arquivo de configuração config.ini não encontrado.');
}

$configData = parse_ini_file($configFile, true, INI_SCANNER_TYPED);
if ($configData === false || !isset($configData['database'])) {
    throw new RuntimeException('Configuração inválida em config.ini.');
}

$config = $configData['database'];
?>
