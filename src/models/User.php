<?php

include_once ROOT_DIR . '/src/core/Database.php';

class User
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = (new DBFactory())->getPDO();
    }

    public function getUserByMail(string $email)
    {
        $stmt = $this->pdo->prepare("
            SELECT * FROM user WHERE user.email = :email
        ");

        $stmt->execute([
            ':email' => $email,
        ]);

        return $stmt->fetch();
    }

    public function getUserById(int $id)
    {
        $stmt = $this->pdo->prepare("
            SELECT * FROM user WHERE user.id = :id
        ");

        $stmt->execute([
            ':id' => $id,
        ]);

        return $stmt->fetch();
    }

    public function insertUser(array $data): void
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO user (firstname, lastname, email, password, status)
            VALUES (:firstname, :lastname, :email, :password, :status) 
        ");

        $stmt->execute([
            ':firstname' => $data['firstname'],
            ':lastname'  => $data['lastname'],
            ':email'     => $data['email'],
            ':password'  => $data['password'],
            ':status'    => $data['status'],
        ]);
    }
}

$userClass = new User();