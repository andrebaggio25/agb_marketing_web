<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Models\PostModel;
use App\Models\SettingModel;

final class BlogController
{
    public function index(Request $req, array $params = []): void
    {
        $posts = PostModel::published(50, 0);
        $settings = SettingModel::allKeyValue();
        $data = [
            'title' => 'Blog — ' . ($settings['site_meta_title'] ?? 'AGB Marketing'),
            'metaDescription' => 'Conteúdos sobre estratégia, performance e crescimento.',
            'posts' => $posts,
            'settings' => $settings,
        ];
        $data['slot'] = View::render('site/blog_index', $data);
        Response::html(View::render('site/layout', $data));
    }

    public function show(Request $req, array $params): void
    {
        $slug = $params['slug'] ?? '';
        $post = PostModel::findBySlug($slug);
        if (!$post) {
            http_response_code(404);
            echo View::render('site/errors/404', ['title' => 'Post não encontrado']);
            exit;
        }
        $settings = SettingModel::allKeyValue();
        $data = [
            'title' => $post['meta_title'] ?: $post['title'],
            'metaDescription' => $post['meta_description'] ?? '',
            'post' => $post,
            'settings' => $settings,
        ];
        $data['slot'] = View::render('site/blog_show', $data);
        Response::html(View::render('site/layout', $data));
    }
}
