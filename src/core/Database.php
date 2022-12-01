<?php

class DBFactory
{
    private array $config;
    private PDO   $pdo;

    public function __construct()
    {
        $config = require ROOT_DIR . '/.config.php';

        $this->config = [
            'host'     => $config['database']['host'],
            'port'     => $config['database']['port'],
            'dbname'   => $config['database']['dbname'],
            'user'     => $config['database']['user'],
            'password' => $config['database']['password'],
            'charset'  => 'utf8mb4',
            'options'  => [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ],
        ];

        $dsn = "mysql:host={$this->config['host']};port={$this->config['port']};dbname={$this->config['dbname']};charset={$this->config['charset']};";

        try {
            $this->pdo = new PDO($dsn, $this->config['user'], $this->config['password'], $this->config['options']);
        } catch (PDOException $e) {
            error_log($e);
            die('DB Error please contact the web admin.');
        }
    }

    public function getPDO(): PDO
    {
        return $this->pdo;
    }
}