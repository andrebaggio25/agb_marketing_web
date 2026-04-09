<?php

declare(strict_types=1);

require dirname(__DIR__) . '/bootstrap.php';

use App\Core\Database;
use App\Services\SeedService;

$pdo = Database::pdo();
SeedService::run($pdo);

echo "Seed concluído. Login admin: andrebaggio25@outlook.com" . PHP_EOL;
