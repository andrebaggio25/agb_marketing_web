<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Auth;
use App\Core\Csrf;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Models\ContentSectionModel;

final class SectionAdminController
{
    public function index(Request $req, array $params = []): void
    {
        Auth::requireAuth();
        $data = [
            'title' => 'Seções da home',
            'sections' => ContentSectionModel::allForAdmin('home'),
        ];
        $data['slot'] = View::render('admin/sections/index', $data);
        Response::html(View::render('admin/layout', $data));
    }

    public function edit(Request $req, array $params): void
    {
        Auth::requireAuth();
        $id = (int) ($params['id'] ?? 0);
        $section = ContentSectionModel::find($id);
        if (!$section) {
            Response::redirect('/admin/sections');
        }
        $data = [
            'title' => 'Editar seção',
            'section' => $section,
        ];
        $data['slot'] = View::render('admin/sections/form', $data);
        Response::html(View::render('admin/layout', $data));
    }

    public function update(Request $req, array $params): void
    {
        Auth::requireAuth();
        if (!Csrf::verify($req->input('_csrf'))) {
            Response::redirect('/admin/sections');
        }
        $id = (int) ($params['id'] ?? 0);
        $section = ContentSectionModel::find($id);
        if (!$section) {
            Response::redirect('/admin/sections');
        }
        ContentSectionModel::update($id, [
            'title' => (string) $req->input('title', ''),
            'subtitle' => (string) $req->input('subtitle', ''),
            'body' => (string) $req->input('body', ''),
            'sort_order' => (int) $req->input('sort_order', 0),
            'is_active' => $req->input('is_active') === '1',
        ]);
        $_SESSION['flash_success'] = 'Seção atualizada.';
        Response::redirect('/admin/sections');
    }
}
