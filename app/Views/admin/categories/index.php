<?php
/** @var array<int, array<string,mixed>> $categories */
use App\Core\Csrf;
?>
<div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
  <h1 class="font-display text-2xl font-bold">Categorias</h1>
  <a href="/admin/categories/create" class="rounded-full bg-gold px-5 py-2 text-sm font-bold uppercase text-charcoal">Nova</a>
</div>
<div class="mt-8 overflow-x-auto rounded-xl border border-white/10">
  <table class="min-w-full text-left text-sm">
    <thead class="border-b border-white/10 bg-white/5 text-xs uppercase text-ivory/45">
      <tr><th class="px-4 py-3">Nome</th><th class="px-4 py-3">Slug</th><th class="px-4 py-3"></th></tr>
    </thead>
    <tbody>
      <?php foreach ($categories as $c): ?>
      <tr class="border-b border-white/5">
        <td class="px-4 py-3"><?= e($c['name']) ?></td>
        <td class="px-4 py-3 text-ivory/55"><?= e($c['slug']) ?></td>
        <td class="px-4 py-3 text-right">
          <a href="/admin/categories/<?= (int) $c['id'] ?>/edit" class="text-gold hover:underline">Editar</a>
          <form action="/admin/categories/<?= (int) $c['id'] ?>/delete" method="post" class="inline" onsubmit="return confirm('Excluir?');">
            <?= Csrf::field() ?>
            <button type="submit" class="ml-3 text-red-400 hover:underline">Excluir</button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
