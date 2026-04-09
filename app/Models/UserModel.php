<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

final class UserModel
{
    public static function find(int $id): ?array
    {
        $stmt = Database::pdo()->prepare('SELECT id, name, email, role, created_at FROM users WHERE id = ? LIMIT 1');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public static function findByEmail(string $email): ?array
    {
        $stmt = Database::pdo()->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    /** @return array<int, array<string,mixed>> */
    public static function all(): array
    {
        return Database::pdo()->query('SELECT id, name, email, role, created_at FROM users ORDER BY id ASC')->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create(array $data): int
    {
        $stmt = Database::pdo()->prepare(
            'INSERT INTO users (name, email, password_hash, role) VALUES (?,?,?,?)'
        );
        $stmt->execute([
            $data['name'],
            $data['email'],
            $data['password_hash'],
            $data['role'] ?? 'editor',
        ]);
        return (int) Database::pdo()->lastInsertId();
    }

    public static function update(int $id, array $data): void
    {
        if (!empty($data['password_hash'])) {
            $stmt = Database::pdo()->prepare('UPDATE users SET name=?, email=?, password_hash=?, role=? WHERE id=?');
            $stmt->execute([$data['name'], $data['email'], $data['password_hash'], $data['role'], $id]);
        } else {
            $stmt = Database::pdo()->prepare('UPDATE users SET name=?, email=?, role=? WHERE id=?');
            $stmt->execute([$data['name'], $data['email'], $data['role'], $id]);
        }
    }

    public static function delete(int $id): void
    {
        $stmt = Database::pdo()->prepare('DELETE FROM users WHERE id = ?');
        $stmt->execute([$id]);
    }
}
