<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Auth;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Models\LeadModel;
use App\Models\PageModel;
use App\Models\PostModel;

final class DashboardController
{
    public function index(Request $req, array $params = []): void
    {
        Auth::requireAuth();
        $leads = LeadModel::all(10);
        $pages = PageModel::all();
        $posts = PostModel::all();
        $data = [
            'title' => 'Painel',
            'recentLeads' => $leads,
            'countPages' => count($pages),
            'countPosts' => count($posts),
        ];
        $data['slot'] = View::render('admin/dashboard', $data);
        Response::html(View::render('admin/layout', $data));
    }
}
