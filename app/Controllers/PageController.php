<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Models\PageModel;
use App\Models\SettingModel;

final class PageController
{
    public function show(Request $req, array $params): void
    {
        $slug = $params['slug'] ?? '';
        $page = PageModel::findBySlug($slug);
        if (!$page) {
            http_response_code(404);
            echo View::render('site/errors/404', ['title' => 'Página não encontrada']);
            exit;
        }
        $settings = SettingModel::allKeyValue();
        $data = [
            'title' => $page['meta_title'] ?: $page['title'],
            'metaDescription' => $page['meta_description'] ?? '',
            'page' => $page,
            'settings' => $settings,
        ];
        $data['slot'] = View::render('site/page', $data);
        Response::html(View::render('site/layout', $data));
    }
}
