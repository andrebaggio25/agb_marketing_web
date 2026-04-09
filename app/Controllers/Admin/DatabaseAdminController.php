<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Auth;
use App\Core\Csrf;
use App\Core\Database;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Services\MigrationService;
use PDOException;

final class DatabaseAdminController
{
    public function index(Request $req, array $params = []): void
    {
        Auth::requireAuth();
        $me = Auth::user();
        if (($me['role'] ?? '') !== 'admin' || !MigrationService::dbAdminEnabled()) {
            $_SESSION['flash_error'] = 'Acesso negado ao gerenciamento do banco de dados.';
            Response::redirect('/admin');
        }

        $pdo = Database::pdo();
        $overview = null;
        $applied = [];
        $pendingNames = [];
        $error = null;

        try {
            $overview = MigrationService::databaseOverview($pdo);
            MigrationService::ensureMigrationsTable($pdo);
            $applied = MigrationService::appliedFilenames($pdo);
            foreach (MigrationService::pendingPaths($pdo) as $p) {
                $pendingNames[] = basename($p);
            }
        } catch (PDOException $e) {
            $error = $e->getMessage();
        }

        $dbCfg = config('database');
        $data = [
            'title' => 'Banco de dados',
            'overview' => $overview,
            'applied' => $applied,
            'pending' => $pendingNames,
            'dbHost' => $dbCfg['host'] ?? '',
            'dbName' => $dbCfg['database'] ?? '',
            'dbUser' => $dbCfg['username'] ?? '',
            'dbPort' => (string) ($dbCfg['port'] ?? '3306'),
            'connectionError' => $error,
        ];
        $data['slot'] = View::render('admin/database/index', $data);
        Response::html(View::render('admin/layout', $data));
    }

    public function migrate(Request $req, array $params = []): void
    {
        Auth::requireAuth();
        $me = Auth::user();
        if (($me['role'] ?? '') !== 'admin' || !MigrationService::dbAdminEnabled()) {
            Response::redirect('/admin');
        }
        if (!Csrf::verify($req->input('_csrf'))) {
            $_SESSION['flash_error'] = 'Sessão inválida.';
            Response::redirect('/admin/database');
        }

        try {
            $pdo = Database::pdo();
            $results = MigrationService::runPending($pdo);
            if ($results === []) {
                $_SESSION['flash_success'] = 'Nenhuma migration pendente.';
            } else {
                $ok = array_filter($results, fn ($r) => $r['ok']);
                $fail = array_filter($results, fn ($r) => !$r['ok']);
                if ($fail !== []) {
                    $f = reset($fail);
                    $_SESSION['flash_error'] = 'Erro em ' . $f['file'] . ': ' . ($f['error'] ?? '');
                } else {
                    $names = array_map(fn ($r) => $r['file'], $ok);
                    $_SESSION['flash_success'] = 'Migrations aplicadas: ' . implode(', ', $names);
                }
            }
        } catch (PDOException $e) {
            $_SESSION['flash_error'] = 'Erro: ' . $e->getMessage();
        }

        Response::redirect('/admin/database');
    }
}
