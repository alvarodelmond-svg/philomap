<?php
class Database {
    private static $instance = null;

    private function __construct() {}

    public static function getConnection() {
        if (self::$instance === null) {
            $config = self::loadConfig();

            if (empty($config['driver'])) {
                throw new RuntimeException('Driver de banco não informado no config.ini.');
            }

            $driver = strtolower($config['driver']);
            switch ($driver) {
                case 'sqlite':
                    $path = $config['path'] ?? null;
                    if (!$path) {
                        throw new RuntimeException('Caminho do banco SQLite não informado em config.ini.');
                    }

                    $dbPath = self::resolvePath($path);
                    $dir = dirname($dbPath);
                    if (!is_dir($dir)) {
                        mkdir($dir, 0777, true);
                    }

                    $dsn = 'sqlite:' . $dbPath;
                    self::$instance = new PDO($dsn);
                    break;

                default:
                    throw new RuntimeException('Driver de banco não suportado: ' . $driver);
            }

            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }

        return self::$instance;
    }

    private static function resolvePath(string $path): string {
        if (preg_match('/^(?:[A-Za-z]:|\\\\|\/)/', $path)) {
            return $path;
        }

        return realpath(__DIR__ . '/../') . DIRECTORY_SEPARATOR . str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);
    }

    private static function loadConfig(): array {
        $configFile = __DIR__ . '/../config.ini';
        if (!file_exists($configFile)) {
            throw new RuntimeException('Arquivo config.ini não encontrado.');
        }

        $parsed = parse_ini_file($configFile, true, INI_SCANNER_TYPED);
        if ($parsed === false || !isset($parsed['database'])) {
            throw new RuntimeException('Configuração inválida em config.ini.');
        }

        return $parsed['database'];
    }
}
