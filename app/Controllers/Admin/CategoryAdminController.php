<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Auth;
use App\Core\Csrf;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Models\CategoryModel;

final class CategoryAdminController
{
    public function index(Request $req, array $params = []): void
    {
        Auth::requireAuth();
        $data = [
            'title' => 'Categorias',
            'categories' => CategoryModel::all(),
        ];
        $data['slot'] = View::render('admin/categories/index', $data);
        Response::html(View::render('admin/layout', $data));
    }

    public function create(Request $req, array $params = []): void
    {
        Auth::requireAuth();
        $data = [
            'title' => 'Nova categoria',
            'category' => null,
        ];
        $data['slot'] = View::render('admin/categories/form', $data);
        Response::html(View::render('admin/layout', $data));
    }

    public function store(Request $req, array $params = []): void
    {
        Auth::requireAuth();
        if (!Csrf::verify($req->input('_csrf'))) {
            Response::redirect('/admin/categories');
        }
        $slug = trim((string) $req->input('slug', ''));
        if ($slug === '') {
            $slug = slugify((string) $req->input('name', 'categoria'));
        }
        CategoryModel::create([
            'name' => trim((string) $req->input('name', '')),
            'slug' => $slug,
        ]);
        $_SESSION['flash_success'] = 'Categoria criada.';
        Response::redirect('/admin/categories');
    }

    public function edit(Request $req, array $params): void
    {
        Auth::requireAuth();
        $id = (int) ($params['id'] ?? 0);
        $cat = CategoryModel::find($id);
        if (!$cat) {
            Response::redirect('/admin/categories');
        }
        $data = [
            'title' => 'Editar categoria',
            'category' => $cat,
        ];
        $data['slot'] = View::render('admin/categories/form', $data);
        Response::html(View::render('admin/layout', $data));
    }

    public function update(Request $req, array $params): void
    {
        Auth::requireAuth();
        if (!Csrf::verify($req->input('_csrf'))) {
            Response::redirect('/admin/categories');
        }
        $id = (int) ($params['id'] ?? 0);
        $cat = CategoryModel::find($id);
        if (!$cat) {
            Response::redirect('/admin/categories');
        }
        $slug = trim((string) $req->input('slug', ''));
        if ($slug === '') {
            $slug = slugify((string) $req->input('name', 'categoria'));
        }
        CategoryModel::update($id, [
            'name' => trim((string) $req->input('name', '')),
            'slug' => $slug,
        ]);
        $_SESSION['flash_success'] = 'Categoria atualizada.';
        Response::redirect('/admin/categories');
    }

    public function destroy(Request $req, array $params): void
    {
        Auth::requireAuth();
        if (!Csrf::verify($req->input('_csrf'))) {
            Response::redirect('/admin/categories');
        }
        $id = (int) ($params['id'] ?? 0);
        CategoryModel::delete($id);
        $_SESSION['flash_success'] = 'Categoria removida.';
        Response::redirect('/admin/categories');
    }
}
