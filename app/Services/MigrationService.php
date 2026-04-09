<?php

declare(strict_types=1);

namespace App\Services;

use PDO;
use PDOException;
use Throwable;

final class MigrationService
{
    public static function ensureMigrationsTable(PDO $pdo): void
    {
        $pdo->exec(
            'CREATE TABLE IF NOT EXISTS schema_migrations (
                filename VARCHAR(255) NOT NULL PRIMARY KEY,
                applied_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci'
        );
    }

    /** @return list<string> paths absolutos */
    public static function migrationFiles(): array
    {
        $dir = BASE_PATH . '/database/migrations';
        if (!is_dir($dir)) {
            return [];
        }
        $files = glob($dir . '/*.sql') ?: [];
        sort($files);
        return $files;
    }

    /** @return list<string> basenames */
    public static function appliedFilenames(PDO $pdo): array
    {
        self::ensureMigrationsTable($pdo);
        $stmt = $pdo->query('SELECT filename FROM schema_migrations ORDER BY filename ASC');
        $rows = $stmt ? $stmt->fetchAll(PDO::FETCH_COLUMN) : [];
        return array_map('strval', $rows);
    }

    /** @return list<string> paths pendentes */
    public static function pendingPaths(PDO $pdo): array
    {
        $applied = array_flip(self::appliedFilenames($pdo));
        $pending = [];
        foreach (self::migrationFiles() as $path) {
            $base = basename($path);
            if (!isset($applied[$base])) {
                $pending[] = $path;
            }
        }
        return $pending;
    }

    /**
     * Executa migrations pendentes, uma a uma, com transação.
     *
     * @return list<array{file: string, ok: bool, error: string|null}>
     */
    public static function runPending(PDO $pdo): array
    {
        self::ensureMigrationsTable($pdo);
        $results = [];
        foreach (self::pendingPaths($pdo) as $path) {
            $base = basename($path);
            $sql = file_get_contents($path);
            if ($sql === false) {
                $results[] = ['file' => $base, 'ok' => false, 'error' => 'Falha ao ler arquivo.'];
                break;
            }
            try {
                // DDL no MySQL não deve ir dentro de transação (implicit commit).
                $pdo->exec($sql);
                $st = $pdo->prepare('INSERT INTO schema_migrations (filename) VALUES (?)');
                $st->execute([$base]);
                $results[] = ['file' => $base, 'ok' => true, 'error' => null];
            } catch (Throwable $e) {
                $results[] = ['file' => $base, 'ok' => false, 'error' => $e->getMessage()];
                break;
            }
        }
        return $results;
    }

    /** @return array{version: string|null, tables: list<array{name: string, rows: int|string|null, engine: string|null}>}|null */
    public static function databaseOverview(PDO $pdo): ?array
    {
        try {
            $version = $pdo->query('SELECT VERSION()')->fetchColumn();
            $version = $version !== false ? (string) $version : null;
        } catch (PDOException) {
            $version = null;
        }

        $tables = [];
        try {
            $stmt = $pdo->query(
                'SELECT TABLE_NAME AS name, TABLE_ROWS AS row_estimate, ENGINE AS engine
                 FROM information_schema.TABLES
                 WHERE TABLE_SCHEMA = DATABASE()
                 ORDER BY TABLE_NAME ASC'
            );
            if ($stmt) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $tables[] = [
                        'name' => (string) $row['name'],
                        'rows' => $row['row_estimate'],
                        'engine' => $row['engine'] !== null ? (string) $row['engine'] : null,
                    ];
                }
            }
        } catch (PDOException) {
            $tables = [];
        }

        return ['version' => $version, 'tables' => $tables];
    }

    public static function dbAdminEnabled(): bool
    {
        return filter_var(getenv('DB_ADMIN_ENABLED') ?: 'true', FILTER_VALIDATE_BOOL);
    }
}
