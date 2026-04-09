<?php

/**
 * Setup inicial após deploy (Git / Hostinger): migrations + seed.
 *
 * Web:  GET https://seudominio.com.br/deploy-setup.php?token=SEU_TOKEN
 * CLI:  php public/deploy-setup.php --token=SEU_TOKEN
 *       php public/deploy-setup.php --token=SEU_TOKEN --force   (reaplica seed/migrations pendentes)
 *
 * Defina no .env: DEPLOY_SETUP_TOKEN=um_segredo_longo_aleatorio
 * Após sucesso, cria .deploy_setup_complete na raiz do projeto — remova ou use --force para rodar de novo.
 */

declare(strict_types=1);

use App\Services\MigrationService;
use App\Services\SeedService;

$basePath = dirname(__DIR__);
$lockFile = $basePath . '/.deploy_setup_complete';
$isCli = PHP_SAPI === 'cli' || PHP_SAPI === 'phpdbg';

if (!$isCli) {
    header('Content-Type: text/plain; charset=utf-8');
    header('X-Robots-Tag: noindex, nofollow');
}

$lines = [];
$fail = false;

$log = static function (string $msg, bool $error = false) use (&$lines, &$fail, $isCli): void {
    $lines[] = ($error ? '[ERRO] ' : '') . $msg;
    if ($error) {
        $fail = true;
    }
    if ($isCli) {
        echo ($error ? '[ERRO] ' : '') . $msg . PHP_EOL;
    }
};

if (!is_file($basePath . '/bootstrap.php')) {
    $log('bootstrap.php não encontrado. Execute a partir da raiz do projeto.', true);
    if (!$isCli) {
        echo implode("\n", $lines);
    }
    exit(1);
}

require $basePath . '/bootstrap.php';

$tokenEnv = trim((string) (getenv('DEPLOY_SETUP_TOKEN') ?: getenv('SETUP_TOKEN') ?: ''));
$provided = '';

if ($isCli) {
    foreach ($argv ?? [] as $arg) {
        if (str_starts_with($arg, '--token=')) {
            $provided = substr($arg, 8);
        }
    }
} else {
    $provided = isset($_GET['token']) ? (string) $_GET['token'] : '';
}

$force = false;
if ($isCli) {
    foreach ($argv ?? [] as $arg) {
        if ($arg === '--force') {
            $force = true;
        }
    }
} else {
    $force = isset($_GET['force']) && $_GET['force'] !== '' && $_GET['force'] !== '0';
}

if ($tokenEnv === '') {
    $log('Defina DEPLOY_SETUP_TOKEN (ou SETUP_TOKEN) no ficheiro .env antes de executar o setup.', true);
    $log('Ex.: DEPLOY_SETUP_TOKEN=' . bin2hex(random_bytes(16)), false);
    if (!$isCli) {
        http_response_code(503);
        echo implode("\n", $lines);
    }
    exit(1);
}

if ($provided === '' || !hash_equals($tokenEnv, $provided)) {
    $log('Token inválido ou em falta.', true);
    if (!$isCli) {
        http_response_code(403);
    }
    if (!$isCli) {
        echo implode("\n", $lines);
    }
    exit(1);
}

if (is_file($lockFile) && !$force) {
    $log('Setup já foi concluído anteriormente. Remova .deploy_setup_complete na raiz ou use --force / ?force=1', true);
    if (!$isCli) {
        http_response_code(409);
        echo implode("\n", $lines);
    }
    exit(1);
}

if (!is_file($basePath . '/.env')) {
    $log('Ficheiro .env não encontrado na raiz. Copie .env.production.example para .env e configure DB_* e APP_URL.', true);
    if (!$isCli) {
        http_response_code(503);
        echo implode("\n", $lines);
    }
    exit(1);
}

$c = config('database');
$dsn = sprintf(
    'mysql:host=%s;port=%d;dbname=%s;charset=%s',
    $c['host'],
    $c['port'],
    $c['database'],
    $c['charset']
);

try {
    $pdo = new PDO($dsn, $c['username'], $c['password'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (Throwable $e) {
    $log('Falha ao ligar ao MySQL: ' . $e->getMessage(), true);
    $log('Confirme DB_HOST, DB_DATABASE, DB_USERNAME e DB_PASSWORD no .env (base já criada no painel).', true);
    if (!$isCli) {
        http_response_code(503);
        echo implode("\n", $lines);
    }
    exit(1);
}

$log('Ligação MySQL OK (' . $c['database'] . ').');

$results = MigrationService::runPending($pdo);
if ($results === []) {
    $log('Migrations: nenhuma pendente.');
} else {
    foreach ($results as $r) {
        if ($r['ok']) {
            $log('Migration OK: ' . $r['file']);
        } else {
            $log('Migration falhou: ' . $r['file'] . ' — ' . ($r['error'] ?? ''), true);
            break;
        }
    }
}

if ($fail) {
    if (!$isCli) {
        http_response_code(500);
        echo implode("\n", $lines);
    }
    exit(1);
}

try {
    SeedService::run($pdo);
    $log('Seed concluído (settings, secções, páginas base, admin inicial).');
} catch (Throwable $e) {
    $log('Seed falhou: ' . $e->getMessage(), true);
    if (!$isCli) {
        http_response_code(500);
        echo implode("\n", $lines);
    }
    exit(1);
}

if (@file_put_contents($lockFile, date('c') . " setup ok\n") === false) {
    $log('Aviso: não foi possível criar .deploy_setup_complete (verifique permissões na raiz).', false);
} else {
    $log('Marcador .deploy_setup_complete criado.');
}

$log('');
$log('Próximos passos:');
$log('- Confirme a password do admin em produção (seed: andrebaggio25@outlook.com)');
$log('- npm run build:css se ainda não enviou public/assets/css/app.css');
$log('- Defina DB_ADMIN_ENABLED=false após validar migrations');
$log('- Opcional: apague deploy-setup.php ou remova DEPLOY_SETUP_TOKEN do .env');

if (!$isCli) {
    echo implode("\n", $lines);
}

exit(0);
