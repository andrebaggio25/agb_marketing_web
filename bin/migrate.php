<?php

declare(strict_types=1);

require dirname(__DIR__) . '/bootstrap.php';

use App\Core\Database;
use App\Services\MigrationService;

$pdo = Database::pdo();
$results = MigrationService::runPending($pdo);

if ($results === []) {
    echo "Nenhuma migration pendente." . PHP_EOL;
    exit(0);
}

foreach ($results as $r) {
    if ($r['ok']) {
        echo "OK: " . $r['file'] . PHP_EOL;
    } else {
        echo "ERRO: " . $r['file'] . " — " . ($r['error'] ?? '') . PHP_EOL;
        exit(1);
    }
}

echo "Migrations concluídas." . PHP_EOL;
