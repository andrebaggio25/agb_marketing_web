<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Csrf;
use App\Core\Request;
use App\Core\Response;
use App\Models\LeadModel;
use App\Services\MailService;

final class LeadController
{
    public function store(Request $req, array $params = []): void
    {
        $wantsJson = str_contains((string) ($_SERVER['HTTP_ACCEPT'] ?? ''), 'application/json')
            || (($req->server['HTTP_X_REQUESTED_WITH'] ?? '') === 'XMLHttpRequest');

        if (!Csrf::verify($req->input('_csrf'))) {
            if ($wantsJson) {
                Response::json(['ok' => false, 'error' => 'Sessão inválida. Atualize a página.'], 419);
            }
            $_SESSION['flash_error'] = 'Sessão expirada. Atualize a página e tente novamente.';
            Response::redirect('/#contato');
        }

        $name = trim((string) $req->input('name', ''));
        $email = trim((string) $req->input('email', ''));
        $phone = trim((string) $req->input('phone', ''));
        $company = trim((string) $req->input('company', ''));
        $message = trim((string) $req->input('message', ''));

        $errors = [];
        if ($name === '' || mb_strlen($name) < 2) {
            $errors['name'] = 'Informe seu nome.';
        }
        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'E-mail inválido.';
        }

        if ($errors !== []) {
            if ($wantsJson) {
                Response::json(['ok' => false, 'errors' => $errors], 422);
            }
            $_SESSION['flash_error'] = implode(' ', $errors);
            Response::redirect('/#contato');
        }

        $id = LeadModel::create([
            'name' => $name,
            'email' => $email,
            'phone' => $phone ?: null,
            'company' => $company ?: null,
            'message' => $message ?: null,
            'source' => 'landing',
            'status' => 'new',
        ]);

        $mailCfg = config('mail');
        $to = $mailCfg['lead_to'] ?? '';
        if ($to !== '') {
            $body = "Novo lead #{$id}\n\n";
            $body .= "Nome: {$name}\nE-mail: {$email}\n";
            if ($phone !== '') {
                $body .= "Telefone: {$phone}\n";
            }
            if ($company !== '') {
                $body .= "Empresa: {$company}\n";
            }
            if ($message !== '') {
                $body .= "\nMensagem:\n{$message}\n";
            }
            MailService::send($to, 'Novo lead — AGB Marketing', $body, $email);
        }

        if ($wantsJson) {
            Response::json(['ok' => true, 'message' => 'Recebemos seus dados. Em breve entraremos em contato.']);
        }

        $_SESSION['flash_success'] = 'Recebemos seus dados. Em breve entraremos em contato.';
        Response::redirect('/#contato');
    }
}
