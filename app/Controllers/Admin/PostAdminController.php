<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Auth;
use App\Core\Csrf;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Models\CategoryModel;
use App\Models\PostModel;

final class PostAdminController
{
    public function index(Request $req, array $params = []): void
    {
        Auth::requireAuth();
        $data = [
            'title' => 'Posts',
            'posts' => PostModel::all(),
        ];
        $data['slot'] = View::render('admin/posts/index', $data);
        Response::html(View::render('admin/layout', $data));
    }

    public function create(Request $req, array $params = []): void
    {
        Auth::requireAuth();
        $data = [
            'title' => 'Novo post',
            'post' => null,
            'categories' => CategoryModel::all(),
        ];
        $data['slot'] = View::render('admin/posts/form', $data);
        Response::html(View::render('admin/layout', $data));
    }

    public function store(Request $req, array $params = []): void
    {
        Auth::requireAuth();
        if (!Csrf::verify($req->input('_csrf'))) {
            Response::redirect('/admin/posts/create');
        }
        $slug = trim((string) $req->input('slug', ''));
        if ($slug === '') {
            $slug = slugify((string) $req->input('title', 'post'));
        }
        $status = $req->input('status') === 'published' ? 'published' : 'draft';
        $pub = trim((string) $req->input('published_at', ''));
        if ($pub !== '') {
            $pub = str_replace('T', ' ', $pub);
            if (preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}$/', $pub)) {
                $pub .= ':00';
            }
        }
        PostModel::create([
            'category_id' => (int) $req->input('category_id', 0) ?: null,
            'title' => trim((string) $req->input('title', '')),
            'slug' => $slug,
            'excerpt' => (string) $req->input('excerpt', ''),
            'body' => (string) $req->input('body', ''),
            'status' => $status,
            'published_at' => $status === 'published' && $pub !== '' ? $pub : ($status === 'published' ? date('Y-m-d H:i:s') : null),
            'meta_title' => (string) $req->input('meta_title', ''),
            'meta_description' => (string) $req->input('meta_description', ''),
        ]);
        $_SESSION['flash_success'] = 'Post criado.';
        Response::redirect('/admin/posts');
    }

    public function edit(Request $req, array $params): void
    {
        Auth::requireAuth();
        $id = (int) ($params['id'] ?? 0);
        $post = PostModel::find($id);
        if (!$post) {
            Response::redirect('/admin/posts');
        }
        $data = [
            'title' => 'Editar post',
            'post' => $post,
            'categories' => CategoryModel::all(),
        ];
        $data['slot'] = View::render('admin/posts/form', $data);
        Response::html(View::render('admin/layout', $data));
    }

    public function update(Request $req, array $params): void
    {
        Auth::requireAuth();
        if (!Csrf::verify($req->input('_csrf'))) {
            Response::redirect('/admin/posts');
        }
        $id = (int) ($params['id'] ?? 0);
        $post = PostModel::find($id);
        if (!$post) {
            Response::redirect('/admin/posts');
        }
        $slug = trim((string) $req->input('slug', ''));
        if ($slug === '') {
            $slug = slugify((string) $req->input('title', 'post'));
        }
        $status = $req->input('status') === 'published' ? 'published' : 'draft';
        $pub = trim((string) $req->input('published_at', ''));
        if ($pub !== '') {
            $pub = str_replace('T', ' ', $pub);
            if (preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}$/', $pub)) {
                $pub .= ':00';
            }
            $pub = substr($pub, 0, 19);
        }
        PostModel::update($id, [
            'category_id' => (int) $req->input('category_id', 0) ?: null,
            'title' => trim((string) $req->input('title', '')),
            'slug' => $slug,
            'excerpt' => (string) $req->input('excerpt', ''),
            'body' => (string) $req->input('body', ''),
            'status' => $status,
            'published_at' => $pub !== '' ? $pub : $post['published_at'],
            'meta_title' => (string) $req->input('meta_title', ''),
            'meta_description' => (string) $req->input('meta_description', ''),
        ]);
        $_SESSION['flash_success'] = 'Post atualizado.';
        Response::redirect('/admin/posts');
    }

    public function destroy(Request $req, array $params): void
    {
        Auth::requireAuth();
        if (!Csrf::verify($req->input('_csrf'))) {
            Response::redirect('/admin/posts');
        }
        $id = (int) ($params['id'] ?? 0);
        PostModel::delete($id);
        $_SESSION['flash_success'] = 'Post removido.';
        Response::redirect('/admin/posts');
    }
}
