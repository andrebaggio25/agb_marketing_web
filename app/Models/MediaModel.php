<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

final class MediaModel
{
    public static function find(int $id): ?array
    {
        $stmt = Database::pdo()->prepare('SELECT * FROM media WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    /** @return array<int, array<string,mixed>> */
    public static function all(int $limit = 100): array
    {
        $limit = max(1, min(500, $limit));
        $sql = 'SELECT * FROM media ORDER BY id DESC LIMIT ' . $limit;
        return Database::pdo()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create(array $data): int
    {
        $stmt = Database::pdo()->prepare(
            'INSERT INTO media (filename, path, mime, size, alt) VALUES (?,?,?,?,?)'
        );
        $stmt->execute([
            $data['filename'],
            $data['path'],
            $data['mime'],
            $data['size'] ?? 0,
            $data['alt'] ?? null,
        ]);
        return (int) Database::pdo()->lastInsertId();
    }

    public static function delete(int $id): void
    {
        $row = self::find($id);
        if ($row) {
            $full = PUBLIC_PATH . $row['path'];
            if (is_file($full)) {
                @unlink($full);
            }
        }
        Database::pdo()->prepare('DELETE FROM media WHERE id = ?')->execute([$id]);
    }
}
