<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Auth;
use App\Core\Csrf;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Models\LeadModel;
use App\Models\LeadNoteModel;

final class LeadAdminController
{
    public function index(Request $req, array $params = []): void
    {
        Auth::requireAuth();
        $data = [
            'title' => 'Leads',
            'leads' => LeadModel::all(500),
        ];
        $data['slot'] = View::render('admin/leads/index', $data);
        Response::html(View::render('admin/layout', $data));
    }

    public function show(Request $req, array $params): void
    {
        Auth::requireAuth();
        $id = (int) ($params['id'] ?? 0);
        $lead = LeadModel::find($id);
        if (!$lead) {
            Response::redirect('/admin/leads');
        }
        $data = [
            'title' => 'Lead #' . $id,
            'lead' => $lead,
            'notes' => LeadNoteModel::forLead($id),
        ];
        $data['slot'] = View::render('admin/leads/show', $data);
        Response::html(View::render('admin/layout', $data));
    }

    public function status(Request $req, array $params): void
    {
        Auth::requireAuth();
        if (!Csrf::verify($req->input('_csrf'))) {
            Response::redirect('/admin/leads');
        }
        $id = (int) ($params['id'] ?? 0);
        $status = (string) $req->input('status', 'new');
        $allowed = ['new', 'contacted', 'qualified', 'lost', 'won'];
        if (!in_array($status, $allowed, true)) {
            $status = 'new';
        }
        LeadModel::updateStatus($id, $status);
        $_SESSION['flash_success'] = 'Status atualizado.';
        Response::redirect('/admin/leads/' . $id);
    }

    public function addNote(Request $req, array $params): void
    {
        Auth::requireAuth();
        if (!Csrf::verify($req->input('_csrf'))) {
            Response::redirect('/admin/leads');
        }
        $id = (int) ($params['id'] ?? 0);
        $body = trim((string) $req->input('body', ''));
        if ($body !== '') {
            $uid = Auth::user()['id'] ?? null;
            LeadNoteModel::create($id, $uid ? (int) $uid : null, $body);
        }
        Response::redirect('/admin/leads/' . $id);
    }
}
