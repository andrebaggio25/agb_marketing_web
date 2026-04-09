<?php
/** @var array<int, array<string,mixed>> $items */
use App\Core\Csrf;
?>
<h1 class="font-display text-2xl font-bold">Biblioteca de mídia</h1>
<form method="post" action="/admin/media" enctype="multipart/form-data" class="mt-6 flex max-w-xl flex-col gap-3 rounded-xl border border-white/10 bg-white/[0.03] p-4 sm:flex-row sm:items-end">
  <?= Csrf::field() ?>
  <div class="flex-1">
    <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Arquivo</label>
    <input type="file" name="file" required accept="image/*" class="w-full text-sm text-ivory/80">
  </div>
  <div class="flex-1">
    <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Alt (opcional)</label>
    <input name="alt" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-sm">
  </div>
  <button type="submit" class="rounded-full bg-gold px-6 py-2 text-sm font-bold uppercase text-charcoal">Enviar</button>
</form>
<div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
  <?php foreach ($items as $m): ?>
  <div class="overflow-hidden rounded-xl border border-white/10 bg-white/[0.02]">
    <?php if (str_starts_with((string) $m['mime'], 'image/')): ?>
    <a href="<?= e($m['path']) ?>" target="_blank" class="block aspect-video bg-black/40">
      <img src="<?= e($m['path']) ?>" alt="<?= e($m['alt'] ?? '') ?>" class="h-full w-full object-contain">
    </a>
    <?php else: ?>
    <div class="p-4 text-xs text-ivory/55"><?= e($m['mime']) ?></div>
    <?php endif; ?>
    <div class="flex items-center justify-between gap-2 border-t border-white/5 p-3 text-xs">
      <code class="truncate text-ivory/55"><?= e($m['path']) ?></code>
      <form action="/admin/media/<?= (int) $m['id'] ?>/delete" method="post" onsubmit="return confirm('Remover?');">
        <?= Csrf::field() ?>
        <button type="submit" class="text-red-400 hover:underline">Excluir</button>
      </form>
    </div>
  </div>
  <?php endforeach; ?>
  <?php if (empty($items)): ?>
  <p class="col-span-full text-ivory/45">Nenhum arquivo.</p>
  <?php endif; ?>
</div>
