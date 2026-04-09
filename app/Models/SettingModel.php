<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

final class SettingModel
{
    /** @return array<string, string|null> */
    public static function allKeyValue(): array
    {
        $rows = Database::pdo()->query('SELECT `key`, `value` FROM settings')->fetchAll(PDO::FETCH_ASSOC);
        $out = [];
        foreach ($rows as $r) {
            $out[$r['key']] = $r['value'];
        }
        return $out;
    }

    public static function get(string $key, ?string $default = null): ?string
    {
        $stmt = Database::pdo()->prepare('SELECT `value` FROM settings WHERE `key` = ? LIMIT 1');
        $stmt->execute([$key]);
        $v = $stmt->fetchColumn();
        return $v !== false ? (string) $v : $default;
    }

    public static function set(string $key, ?string $value): void
    {
        $stmt = Database::pdo()->prepare(
            'INSERT INTO settings (`key`, `value`) VALUES (?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`)'
        );
        $stmt->execute([$key, $value]);
    }
}
