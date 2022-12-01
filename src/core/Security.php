<?php

class Security
{
    public function createPassword(string $password): string
    {
        return password_hash($password, PASSWORD_ARGON2ID);
    }

    public function checkPassword(string $input, string $dbPassword): bool
    {
        return password_verify($input, $dbPassword);
    }

    public function isLogged(array $session): void
    {
        if (!$session) {
            header('Location: /');
            exit;
        }
    }
}

$securityClass = new Security();