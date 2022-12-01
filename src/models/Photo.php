<?php

include_once  ROOT_DIR . '/src/core/Database.php';

class Photo
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = (new DBFactory())->getPDO();
    }

    public function addPhoto(array $photo): void
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO gallery (name, category_id, type)
            VALUES (:name, :category, :type) 
        ");

        $stmt->execute([
            ':name'    => $photo['name'],
            ':category' => $photo['category'],
            ':type'  => $photo['type']
        ]);
    }

    public function getAllPhotos(): bool | array
    {
        $stmt = $this->pdo->prepare("
        SELECT * FROM gallery
        ");

        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllPhotosFromCategory(string $category): bool|array
    {
        $stmt = $this->pdo->prepare("
            SELECT gallery.*, category.name as catName, category.slug as catSlug
            FROM gallery
            LEFT JOIN category
                ON gallery.category_id = category.id 
            WHERE category.slug = :category
        ");

        $stmt->execute([
            ':category' => $category
        ]);

        return $stmt->fetchAll();
    }

    public function deletePhoto(int $id): void
    {
        $stmt = $this->pdo->prepare("
            DELETE FROM gallery WHERE id = :article_id
        ");

        $stmt->execute([
            ':article_id' => $id
        ]);
    }

    public function getOnePhoto(int $id): bool | array
    {
        $stmt = $this->pdo->prepare("
        SELECT * FROM gallery WHERE id = :id
        ");

        $stmt->execute([
            'id' => $id
        ]);
        return $stmt->fetch();
    }

    public function getClassActive($categories)
    {
        $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') === FALSE ? 'http' : 'https';
        $host     = $_SERVER['HTTP_HOST'];
        $script   = $_SERVER['SCRIPT_NAME'];
        $queryString   = $_SERVER['QUERY_STRING'];
        $url = $protocol . '://' . $host . $script . '?' . $queryString;

        $parsedUrl = parse_url($url);
        $params = [];
        parse_str($parsedUrl['query'], $params);

        if (in_array($params['cat'], $categories)) {
            return 'active';
        }

        return null;
    }
}

$photos = new Photo();
