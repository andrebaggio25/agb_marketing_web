<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

final class CategoryModel
{
    public static function find(int $id): ?array
    {
        $stmt = Database::pdo()->prepare('SELECT * FROM categories WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    /** @return array<int, array<string,mixed>> */
    public static function all(): array
    {
        return Database::pdo()->query('SELECT * FROM categories ORDER BY name ASC')->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create(array $data): int
    {
        $stmt = Database::pdo()->prepare('INSERT INTO categories (name, slug) VALUES (?,?)');
        $stmt->execute([$data['name'], $data['slug']]);
        return (int) Database::pdo()->lastInsertId();
    }

    public static function update(int $id, array $data): void
    {
        $stmt = Database::pdo()->prepare('UPDATE categories SET name=?, slug=? WHERE id=?');
        $stmt->execute([$data['name'], $data['slug'], $id]);
    }

    public static function delete(int $id): void
    {
        Database::pdo()->prepare('DELETE FROM categories WHERE id = ?')->execute([$id]);
    }
}
