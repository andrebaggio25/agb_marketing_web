<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

final class LeadModel
{
    public static function find(int $id): ?array
    {
        $stmt = Database::pdo()->prepare('SELECT * FROM leads WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    /** @return array<int, array<string,mixed>> */
    public static function all(int $limit = 200): array
    {
        $limit = max(1, min(2000, $limit));
        $sql = 'SELECT * FROM leads ORDER BY created_at DESC LIMIT ' . $limit;
        return Database::pdo()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create(array $data): int
    {
        $stmt = Database::pdo()->prepare(
            'INSERT INTO leads (name, email, phone, company, message, source, status) VALUES (?,?,?,?,?,?,?)'
        );
        $stmt->execute([
            $data['name'],
            $data['email'],
            $data['phone'] ?? null,
            $data['company'] ?? null,
            $data['message'] ?? null,
            $data['source'] ?? 'landing',
            $data['status'] ?? 'new',
        ]);
        return (int) Database::pdo()->lastInsertId();
    }

    public static function updateStatus(int $id, string $status): void
    {
        $stmt = Database::pdo()->prepare('UPDATE leads SET status = ? WHERE id = ?');
        $stmt->execute([$status, $id]);
    }
}
