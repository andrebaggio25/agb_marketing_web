<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

final class ContentSectionModel
{
    /** @return array<string, array<string,mixed>> keyed by section_key */
    public static function byPageKey(string $pageKey): array
    {
        $stmt = Database::pdo()->prepare(
            'SELECT * FROM content_sections WHERE page_key = ? AND is_active = 1 ORDER BY sort_order ASC, id ASC'
        );
        $stmt->execute([$pageKey]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $out = [];
        foreach ($rows as $r) {
            $out[$r['section_key']] = $r;
        }
        return $out;
    }

    /** @return array<int, array<string,mixed>> */
    public static function allForAdmin(string $pageKey = 'home'): array
    {
        $stmt = Database::pdo()->prepare(
            'SELECT * FROM content_sections WHERE page_key = ? ORDER BY sort_order ASC, id ASC'
        );
        $stmt->execute([$pageKey]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find(int $id): ?array
    {
        $stmt = Database::pdo()->prepare('SELECT * FROM content_sections WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public static function update(int $id, array $data): void
    {
        $stmt = Database::pdo()->prepare(
            'UPDATE content_sections SET title=?, subtitle=?, body=?, sort_order=?, is_active=? WHERE id=?'
        );
        $stmt->execute([
            $data['title'] ?? null,
            $data['subtitle'] ?? null,
            $data['body'] ?? null,
            (int) ($data['sort_order'] ?? 0),
            !empty($data['is_active']) ? 1 : 0,
            $id,
        ]);
    }
}
