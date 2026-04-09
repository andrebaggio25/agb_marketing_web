<?php
/** @var string $title */
/** @var string $slot */
use App\Core\Auth;
$u = Auth::user();
$isAdmin = ($u['role'] ?? '') === 'admin';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($title ?? 'Admin') ?> — AGB</title>
  <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body class="min-h-screen bg-charcoal font-body text-ivory">
  <div class="flex min-h-screen">
    <aside class="hidden w-56 shrink-0 border-r border-white/10 bg-burgundy-dark/50 p-4 lg:block">
      <a href="/admin" class="block font-display text-lg font-bold text-gold">AGB Admin</a>
      <nav class="mt-8 space-y-1 text-sm font-semibold">
        <a href="/admin" class="block rounded-lg px-3 py-2 hover:bg-white/5">Painel</a>
        <a href="/admin/leads" class="block rounded-lg px-3 py-2 hover:bg-white/5">Leads</a>
        <a href="/admin/sections" class="block rounded-lg px-3 py-2 hover:bg-white/5">Seções (home)</a>
        <a href="/admin/pages" class="block rounded-lg px-3 py-2 hover:bg-white/5">Páginas</a>
        <a href="/admin/posts" class="block rounded-lg px-3 py-2 hover:bg-white/5">Posts</a>
        <a href="/admin/categories" class="block rounded-lg px-3 py-2 hover:bg-white/5">Categorias</a>
        <a href="/admin/media" class="block rounded-lg px-3 py-2 hover:bg-white/5">Mídia</a>
        <?php if ($isAdmin): ?>
        <a href="/admin/users" class="block rounded-lg px-3 py-2 hover:bg-white/5">Usuários</a>
        <a href="/admin/settings" class="block rounded-lg px-3 py-2 hover:bg-white/5">Configurações</a>
        <a href="/admin/database" class="block rounded-lg px-3 py-2 hover:bg-white/5">Banco de dados</a>
        <?php endif; ?>
        <a href="/" target="_blank" class="mt-6 block rounded-lg px-3 py-2 text-gold/80 hover:bg-white/5">Ver site</a>
        <a href="/admin/logout" class="block rounded-lg px-3 py-2 text-ivory/50 hover:text-ivory">Sair</a>
      </nav>
    </aside>
    <div class="flex min-w-0 flex-1 flex-col">
      <header class="flex items-center justify-between border-b border-white/10 px-4 py-3 lg:hidden">
        <span class="font-display font-bold text-gold">AGB</span>
        <a href="/admin/logout" class="text-sm text-ivory/60">Sair</a>
      </header>
      <main class="flex-1 p-4 sm:p-8">
        <?php if (!empty($_SESSION['flash_success'])): ?>
        <div class="mb-4 rounded-xl border border-gold/30 bg-gold/10 px-4 py-3 text-sm font-medium text-gold"><?= e($_SESSION['flash_success']) ?></div>
        <?php unset($_SESSION['flash_success']); endif; ?>
        <?php if (!empty($_SESSION['flash_error'])): ?>
        <div class="mb-4 rounded-xl border border-red-500/40 bg-red-500/10 px-4 py-3 text-sm text-red-300"><?= e($_SESSION['flash_error']) ?></div>
        <?php unset($_SESSION['flash_error']); endif; ?>
        <?= $slot ?>
      </main>
    </div>
  </div>
</body>
</html>
