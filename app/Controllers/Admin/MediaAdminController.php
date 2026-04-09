<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Auth;
use App\Core\Csrf;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Models\MediaModel;

final class MediaAdminController
{
    public function index(Request $req, array $params = []): void
    {
        Auth::requireAuth();
        $data = [
            'title' => 'Mídia',
            'items' => MediaModel::all(200),
        ];
        $data['slot'] = View::render('admin/media/index', $data);
        Response::html(View::render('admin/layout', $data));
    }

    public function upload(Request $req, array $params = []): void
    {
        Auth::requireAuth();
        if (!Csrf::verify($req->input('_csrf'))) {
            $_SESSION['flash_error'] = 'Sessão inválida.';
            Response::redirect('/admin/media');
        }
        if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['flash_error'] = 'Envio de arquivo falhou.';
            Response::redirect('/admin/media');
        }
        $f = $_FILES['file'];
        $mime = mime_content_type($f['tmp_name']) ?: 'application/octet-stream';
        $allowed = ['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml', 'image/gif'];
        if (!in_array($mime, $allowed, true)) {
            $_SESSION['flash_error'] = 'Tipo de arquivo não permitido.';
            Response::redirect('/admin/media');
        }
        $ext = pathinfo($f['name'], PATHINFO_EXTENSION);
        $safe = preg_replace('/[^a-zA-Z0-9._-]/', '_', basename($f['name'], '.' . $ext));
        $subdir = date('Y/m');
        $dir = PUBLIC_PATH . '/uploads/' . $subdir;
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $newName = uniqid('media_', true) . ($ext ? '.' . strtolower($ext) : '');
        $dest = $dir . '/' . $newName;
        if (!move_uploaded_file($f['tmp_name'], $dest)) {
            $_SESSION['flash_error'] = 'Não foi possível salvar o arquivo.';
            Response::redirect('/admin/media');
        }
        $publicPath = '/uploads/' . $subdir . '/' . $newName;
        MediaModel::create([
            'filename' => $safe ?: $newName,
            'path' => $publicPath,
            'mime' => $mime,
            'size' => (int) filesize($dest),
            'alt' => (string) $req->input('alt', ''),
        ]);
        $_SESSION['flash_success'] = 'Arquivo enviado.';
        Response::redirect('/admin/media');
    }

    public function destroy(Request $req, array $params): void
    {
        Auth::requireAuth();
        if (!Csrf::verify($req->input('_csrf'))) {
            Response::redirect('/admin/media');
        }
        $id = (int) ($params['id'] ?? 0);
        MediaModel::delete($id);
        $_SESSION['flash_success'] = 'Arquivo removido.';
        Response::redirect('/admin/media');
    }
}
