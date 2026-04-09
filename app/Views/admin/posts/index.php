<?php
/** @var array<int, array<string,mixed>> $posts */
use App\Core\Csrf;
?>
<div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
  <h1 class="font-display text-2xl font-bold">Posts</h1>
  <a href="/admin/posts/create" class="rounded-full bg-gold px-5 py-2 text-sm font-bold uppercase text-charcoal">Novo post</a>
</div>
<div class="mt-8 overflow-x-auto rounded-xl border border-white/10">
  <table class="min-w-full text-left text-sm">
    <thead class="border-b border-white/10 bg-white/5 text-xs uppercase text-ivory/45">
      <tr>
        <th class="px-4 py-3">Título</th>
        <th class="px-4 py-3">Categoria</th>
        <th class="px-4 py-3">Status</th>
        <th class="px-4 py-3"></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($posts as $p): ?>
      <tr class="border-b border-white/5">
        <td class="px-4 py-3 font-medium"><?= e($p['title']) ?></td>
        <td class="px-4 py-3 text-ivory/55"><?= e($p['category_name'] ?? '—') ?></td>
        <td class="px-4 py-3"><?= e($p['status']) ?></td>
        <td class="px-4 py-3 text-right">
          <a href="/blog/<?= e($p['slug']) ?>" target="_blank" class="text-gold/80 hover:underline">Ver</a>
          <a href="/admin/posts/<?= (int) $p['id'] ?>/edit" class="ml-3 text-gold hover:underline">Editar</a>
          <form action="/admin/posts/<?= (int) $p['id'] ?>/delete" method="post" class="inline" onsubmit="return confirm('Remover post?');">
            <?= Csrf::field() ?>
            <button type="submit" class="ml-3 text-red-400 hover:underline">Excluir</button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
