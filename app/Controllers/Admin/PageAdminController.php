<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Auth;
use App\Core\Csrf;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Models\PageModel;

final class PageAdminController
{
    public function index(Request $req, array $params = []): void
    {
        Auth::requireAuth();
        $data = [
            'title' => 'Páginas',
            'pages' => PageModel::all(),
        ];
        $data['slot'] = View::render('admin/pages/index', $data);
        Response::html(View::render('admin/layout', $data));
    }

    public function create(Request $req, array $params = []): void
    {
        Auth::requireAuth();
        $data = [
            'title' => 'Nova página',
            'page' => null,
        ];
        $data['slot'] = View::render('admin/pages/form', $data);
        Response::html(View::render('admin/layout', $data));
    }

    public function store(Request $req, array $params = []): void
    {
        Auth::requireAuth();
        if (!Csrf::verify($req->input('_csrf'))) {
            $_SESSION['flash_error'] = 'Sessão inválida.';
            Response::redirect('/admin/pages/create');
        }
        $slug = trim((string) $req->input('slug', ''));
        if ($slug === '') {
            $slug = slugify((string) $req->input('title', 'pagina'));
        }
        PageModel::create([
            'title' => trim((string) $req->input('title', '')),
            'slug' => $slug,
            'body' => (string) $req->input('body', ''),
            'status' => $req->input('status') === 'published' ? 'published' : 'draft',
            'meta_title' => (string) $req->input('meta_title', ''),
            'meta_description' => (string) $req->input('meta_description', ''),
        ]);
        $_SESSION['flash_success'] = 'Página criada.';
        Response::redirect('/admin/pages');
    }

    public function edit(Request $req, array $params): void
    {
        Auth::requireAuth();
        $id = (int) ($params['id'] ?? 0);
        $page = PageModel::find($id);
        if (!$page) {
            Response::redirect('/admin/pages');
        }
        $data = [
            'title' => 'Editar página',
            'page' => $page,
        ];
        $data['slot'] = View::render('admin/pages/form', $data);
        Response::html(View::render('admin/layout', $data));
    }

    public function update(Request $req, array $params): void
    {
        Auth::requireAuth();
        if (!Csrf::verify($req->input('_csrf'))) {
            $_SESSION['flash_error'] = 'Sessão inválida.';
            Response::redirect('/admin/pages');
        }
        $id = (int) ($params['id'] ?? 0);
        $page = PageModel::find($id);
        if (!$page) {
            Response::redirect('/admin/pages');
        }
        $slug = trim((string) $req->input('slug', ''));
        if ($slug === '') {
            $slug = slugify((string) $req->input('title', 'pagina'));
        }
        PageModel::update($id, [
            'title' => trim((string) $req->input('title', '')),
            'slug' => $slug,
            'body' => (string) $req->input('body', ''),
            'status' => $req->input('status') === 'published' ? 'published' : 'draft',
            'meta_title' => (string) $req->input('meta_title', ''),
            'meta_description' => (string) $req->input('meta_description', ''),
        ]);
        $_SESSION['flash_success'] = 'Página atualizada.';
        Response::redirect('/admin/pages');
    }

    public function destroy(Request $req, array $params): void
    {
        Auth::requireAuth();
        if (!Csrf::verify($req->input('_csrf'))) {
            Response::redirect('/admin/pages');
        }
        $id = (int) ($params['id'] ?? 0);
        PageModel::delete($id);
        $_SESSION['flash_success'] = 'Página removida.';
        Response::redirect('/admin/pages');
    }
}
