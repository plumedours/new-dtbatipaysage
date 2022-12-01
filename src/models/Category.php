<?php

include_once  ROOT_DIR . '/src/core/Database.php';

class Category
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = (new DBFactory())->getPDO();
    }

    public function getAllCategories(): bool|array
    {
        $stmt = $this->pdo->prepare("
            SELECT *
            FROM category
        ");

        $stmt->execute();

        return $stmt->fetchAll();
    }
}

$categoryClass = new Category();