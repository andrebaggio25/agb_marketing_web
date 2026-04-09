<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Models\ContentSectionModel;
use App\Models\SettingModel;

final class HomeController
{
    public function index(Request $req, array $params = []): void
    {
        $sections = ContentSectionModel::byPageKey('home');
        $settings = SettingModel::allKeyValue();
        $data = [
            'title' => $settings['site_meta_title'] ?? 'AGB Marketing',
            'metaDescription' => $settings['site_meta_description'] ?? '',
            'sections' => $sections,
            'settings' => $settings,
            'bodyClass' => 'min-h-screen bg-landing text-charcoal antialiased selection:bg-burgundy/15 selection:text-burgundy-dark',
        ];
        $data['slot'] = View::render('site/home', $data);
        Response::html(View::render('site/layout', $data));
    }
}
