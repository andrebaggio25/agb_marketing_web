<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Auth;
use App\Core\Csrf;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Models\UserModel;

final class AuthController
{
    public function loginForm(Request $req, array $params = []): void
    {
        if (Auth::check()) {
            Response::redirect('/admin');
        }
        Response::html(View::render('admin/auth/login', [
            'title' => 'Entrar',
        ]));
    }

    public function login(Request $req, array $params = []): void
    {
        if (!Csrf::verify($req->input('_csrf'))) {
            $_SESSION['flash_error'] = 'Sessão expirada.';
            Response::redirect('/admin/login');
        }
        $email = trim((string) $req->input('email', ''));
        $password = (string) $req->input('password', '');
        $user = UserModel::findByEmail($email);
        if (!$user || !password_verify($password, $user['password_hash'])) {
            $_SESSION['flash_error'] = 'Credenciais inválidas.';
            Response::redirect('/admin/login');
        }
        Auth::login((int) $user['id']);
        Response::redirect('/admin');
    }

    public function logout(Request $req, array $params = []): void
    {
        Auth::logout();
        Response::redirect('/admin/login');
    }
}
