<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Auth;
use App\Core\Csrf;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Models\UserModel;

final class UserAdminController
{
    public function index(Request $req, array $params = []): void
    {
        Auth::requireAuth();
        $me = Auth::user();
        if (($me['role'] ?? '') !== 'admin') {
            Response::redirect('/admin');
        }
        $data = [
            'title' => 'Usuários',
            'users' => UserModel::all(),
        ];
        $data['slot'] = View::render('admin/users/index', $data);
        Response::html(View::render('admin/layout', $data));
    }

    public function create(Request $req, array $params = []): void
    {
        Auth::requireAuth();
        $me = Auth::user();
        if (($me['role'] ?? '') !== 'admin') {
            Response::redirect('/admin');
        }
        $data = [
            'title' => 'Novo usuário',
            'user' => null,
            'userId' => null,
        ];
        $data['slot'] = View::render('admin/users/form', $data);
        Response::html(View::render('admin/layout', $data));
    }

    public function store(Request $req, array $params = []): void
    {
        Auth::requireAuth();
        $me = Auth::user();
        if (($me['role'] ?? '') !== 'admin' || !Csrf::verify($req->input('_csrf'))) {
            Response::redirect('/admin/users');
        }
        $pass = (string) $req->input('password', '');
        if (strlen($pass) < 8) {
            $_SESSION['flash_error'] = 'Senha com no mínimo 8 caracteres.';
            Response::redirect('/admin/users/create');
        }
        UserModel::create([
            'name' => trim((string) $req->input('name', '')),
            'email' => trim((string) $req->input('email', '')),
            'password_hash' => password_hash($pass, PASSWORD_DEFAULT),
            'role' => $req->input('role') === 'admin' ? 'admin' : 'editor',
        ]);
        $_SESSION['flash_success'] = 'Usuário criado.';
        Response::redirect('/admin/users');
    }

    public function edit(Request $req, array $params): void
    {
        Auth::requireAuth();
        $me = Auth::user();
        if (($me['role'] ?? '') !== 'admin') {
            Response::redirect('/admin');
        }
        $id = (int) ($params['id'] ?? 0);
        $user = UserModel::find($id);
        if (!$user) {
            Response::redirect('/admin/users');
        }
        $data = [
            'title' => 'Editar usuário',
            'user' => $user,
            'userId' => $id,
        ];
        $data['slot'] = View::render('admin/users/form', $data);
        Response::html(View::render('admin/layout', $data));
    }

    public function update(Request $req, array $params): void
    {
        Auth::requireAuth();
        $me = Auth::user();
        if (($me['role'] ?? '') !== 'admin' || !Csrf::verify($req->input('_csrf'))) {
            Response::redirect('/admin/users');
        }
        $id = (int) ($params['id'] ?? 0);
        $user = UserModel::find($id);
        if (!$user) {
            Response::redirect('/admin/users');
        }
        $data = [
            'name' => trim((string) $req->input('name', '')),
            'email' => trim((string) $req->input('email', '')),
            'role' => $req->input('role') === 'admin' ? 'admin' : 'editor',
        ];
        $pass = (string) $req->input('password', '');
        if ($pass !== '') {
            if (strlen($pass) < 8) {
                $_SESSION['flash_error'] = 'Senha com no mínimo 8 caracteres.';
                Response::redirect('/admin/users/' . $id . '/edit');
            }
            $data['password_hash'] = password_hash($pass, PASSWORD_DEFAULT);
        }
        UserModel::update($id, $data);
        $_SESSION['flash_success'] = 'Usuário atualizado.';
        Response::redirect('/admin/users');
    }

    public function destroy(Request $req, array $params): void
    {
        Auth::requireAuth();
        $me = Auth::user();
        if (($me['role'] ?? '') !== 'admin' || !Csrf::verify($req->input('_csrf'))) {
            Response::redirect('/admin/users');
        }
        $id = (int) ($params['id'] ?? 0);
        if ($id === (int) ($me['id'] ?? 0)) {
            $_SESSION['flash_error'] = 'Você não pode excluir seu próprio usuário.';
            Response::redirect('/admin/users');
        }
        UserModel::delete($id);
        $_SESSION['flash_success'] = 'Usuário removido.';
        Response::redirect('/admin/users');
    }
}
