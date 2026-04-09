<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

final class PostModel
{
    public static function find(int $id): ?array
    {
        $stmt = Database::pdo()->prepare(
            'SELECT p.*, c.name AS category_name, c.slug AS category_slug FROM posts p
             LEFT JOIN categories c ON c.id = p.category_id WHERE p.id = ?'
        );
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public static function findBySlug(string $slug): ?array
    {
        $stmt = Database::pdo()->prepare(
            'SELECT p.*, c.name AS category_name, c.slug AS category_slug FROM posts p
             LEFT JOIN categories c ON c.id = p.category_id
             WHERE p.slug = ? AND p.status = ? LIMIT 1'
        );
        $stmt->execute([$slug, 'published']);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    /** @return array<int, array<string,mixed>> */
    public static function published(int $limit = 20, int $offset = 0): array
    {
        $limit = max(1, min(100, $limit));
        $offset = max(0, $offset);
        $sql = 'SELECT p.*, c.name AS category_name FROM posts p
             LEFT JOIN categories c ON c.id = p.category_id
             WHERE p.status = ? ORDER BY COALESCE(p.published_at, p.created_at) DESC LIMIT ' . $limit . ' OFFSET ' . $offset;
        $stmt = Database::pdo()->prepare($sql);
        $stmt->execute(['published']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** @return array<int, array<string,mixed>> */
    public static function all(): array
    {
        return Database::pdo()->query(
            'SELECT p.*, c.name AS category_name FROM posts p
             LEFT JOIN categories c ON c.id = p.category_id ORDER BY p.updated_at DESC'
        )->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create(array $data): int
    {
        $stmt = Database::pdo()->prepare(
            'INSERT INTO posts (category_id, title, slug, excerpt, body, status, published_at, meta_title, meta_description)
             VALUES (?,?,?,?,?,?,?,?,?)'
        );
        $stmt->execute([
            $data['category_id'] ?: null,
            $data['title'],
            $data['slug'],
            $data['excerpt'] ?? null,
            $data['body'] ?? null,
            $data['status'] ?? 'draft',
            $data['published_at'] ?? null,
            $data['meta_title'] ?? null,
            $data['meta_description'] ?? null,
        ]);
        return (int) Database::pdo()->lastInsertId();
    }

    public static function update(int $id, array $data): void
    {
        $stmt = Database::pdo()->prepare(
            'UPDATE posts SET category_id=?, title=?, slug=?, excerpt=?, body=?, status=?, published_at=?, meta_title=?, meta_description=? WHERE id=?'
        );
        $stmt->execute([
            $data['category_id'] ?: null,
            $data['title'],
            $data['slug'],
            $data['excerpt'] ?? null,
            $data['body'] ?? null,
            $data['status'] ?? 'draft',
            $data['published_at'] ?? null,
            $data['meta_title'] ?? null,
            $data['meta_description'] ?? null,
            $id,
        ]);
    }

    public static function delete(int $id): void
    {
        Database::pdo()->prepare('DELETE FROM posts WHERE id = ?')->execute([$id]);
    }
}
