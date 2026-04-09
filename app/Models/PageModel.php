<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

final class PageModel
{
    public static function find(int $id): ?array
    {
        $stmt = Database::pdo()->prepare('SELECT * FROM pages WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public static function findBySlug(string $slug): ?array
    {
        $stmt = Database::pdo()->prepare('SELECT * FROM pages WHERE slug = ? AND status = ? LIMIT 1');
        $stmt->execute([$slug, 'published']);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    /** @return array<int, array<string,mixed>> */
    public static function all(): array
    {
        return Database::pdo()->query('SELECT * FROM pages ORDER BY updated_at DESC')->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create(array $data): int
    {
        $stmt = Database::pdo()->prepare(
            'INSERT INTO pages (title, slug, body, status, meta_title, meta_description) VALUES (?,?,?,?,?,?)'
        );
        $stmt->execute([
            $data['title'],
            $data['slug'],
            $data['body'] ?? null,
            $data['status'] ?? 'draft',
            $data['meta_title'] ?? null,
            $data['meta_description'] ?? null,
        ]);
        return (int) Database::pdo()->lastInsertId();
    }

    public static function update(int $id, array $data): void
    {
        $stmt = Database::pdo()->prepare(
            'UPDATE pages SET title=?, slug=?, body=?, status=?, meta_title=?, meta_description=? WHERE id=?'
        );
        $stmt->execute([
            $data['title'],
            $data['slug'],
            $data['body'] ?? null,
            $data['status'] ?? 'draft',
            $data['meta_title'] ?? null,
            $data['meta_description'] ?? null,
            $id,
        ]);
    }

    public static function delete(int $id): void
    {
        Database::pdo()->prepare('DELETE FROM pages WHERE id = ?')->execute([$id]);
    }
}
