<?php

class Session
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function set(string $key, string $value): string
    {
        return $_SESSION[$key] = $value;
    }

    public function get(string $key): string|null
    {
        return $_SESSION[$key] ?? null;
    }

    public function all(): ?array
    {
        return $_SESSION ?? null;
    }

    public function clear(?string $key = null)
    {
        if ($key === null) {
            session_destroy();
            header('Location: /');
            exit;
        }
        if (array_key_exists($key, $_SESSION)) {
            unset($_SESSION[$key]);
        }
        return $this;
    }

    public function checkAdmin(): bool|string
    {
        return $this->get('status') === 'admin' ?? false;
    }

    public function redirectIfNotAdmin(): void
    {
        if ($this->get('status') !== 'admin') {
            header('Location: /');
            exit;
        }
    }
}

