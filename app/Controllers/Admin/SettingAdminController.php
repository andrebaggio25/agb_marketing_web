<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Auth;
use App\Core\Csrf;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Models\SettingModel;

final class SettingAdminController
{
    public function index(Request $req, array $params = []): void
    {
        Auth::requireAuth();
        $me = Auth::user();
        if (($me['role'] ?? '') !== 'admin') {
            Response::redirect('/admin');
        }
        $data = [
            'title' => 'Configurações',
            'settings' => SettingModel::allKeyValue(),
        ];
        $data['slot'] = View::render('admin/settings/index', $data);
        Response::html(View::render('admin/layout', $data));
    }

    public function update(Request $req, array $params = []): void
    {
        Auth::requireAuth();
        $me = Auth::user();
        if (($me['role'] ?? '') !== 'admin' || !Csrf::verify($req->input('_csrf'))) {
            Response::redirect('/admin/settings');
        }
        $keys = [
            'site_meta_title',
            'site_meta_description',
            'contact_email',
            'contact_phone',
            'whatsapp_url',
            'logo_path',
            'logo_dark_path',
            'favicon_path',
        ];
        foreach ($keys as $k) {
            SettingModel::set($k, trim((string) $req->input($k, '')) ?: null);
        }
        $_SESSION['flash_success'] = 'Configurações salvas.';
        Response::redirect('/admin/settings');
    }
}
