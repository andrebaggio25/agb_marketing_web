<?php
/** @var string $title */
use App\Core\Csrf;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($title ?? 'Entrar') ?></title>
  <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body class="flex min-h-screen items-center justify-center bg-charcoal px-4">
  <div class="w-full max-w-md rounded-2xl border border-white/10 bg-burgundy-dark/40 p-8 shadow-card">
    <h1 class="text-center font-display text-2xl font-bold text-ivory">Painel AGB</h1>
    <p class="mt-2 text-center text-sm text-ivory/55">Acesso restrito</p>
    <?php if (!empty($_SESSION['flash_error'])): ?>
    <p class="mt-4 rounded-lg bg-red-500/15 px-3 py-2 text-center text-sm text-red-300"><?= e($_SESSION['flash_error']) ?></p>
    <?php unset($_SESSION['flash_error']); endif; ?>
    <form method="post" action="/admin/login" class="mt-8 space-y-4">
      <?= Csrf::field() ?>
      <div>
        <label class="mb-1 block text-xs font-bold uppercase text-ivory/50" for="email">E-mail</label>
        <input class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-ivory focus:border-gold/50 focus:outline-none" type="email" id="email" name="email" required autocomplete="username">
      </div>
      <div>
        <label class="mb-1 block text-xs font-bold uppercase text-ivory/50" for="password">Senha</label>
        <input class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-ivory focus:border-gold/50 focus:outline-none" type="password" id="password" name="password" required autocomplete="current-password">
      </div>
      <button type="submit" class="w-full rounded-full bg-gold py-3 text-sm font-bold uppercase tracking-wider text-charcoal">Entrar</button>
    </form>
  </div>
</body>
</html>
