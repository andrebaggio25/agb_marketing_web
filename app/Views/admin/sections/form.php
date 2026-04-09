<?php
/** @var array<string,mixed> $section */
use App\Core\Csrf;
?>
<h1 class="font-display text-2xl font-bold">Editar seção: <span class="text-gold"><?= e($section['section_key']) ?></span></h1>
<form method="post" action="/admin/sections/<?= (int) $section['id'] ?>" class="mt-8 max-w-3xl space-y-4">
  <?= Csrf::field() ?>
  <div>
    <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Título</label>
    <input name="title" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2" value="<?= e($section['title'] ?? '') ?>">
  </div>
  <div>
    <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Subtítulo</label>
    <input name="subtitle" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2" value="<?= e($section['subtitle'] ?? '') ?>">
  </div>
  <div>
    <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Corpo (texto longo / HTML simples)</label>
    <textarea name="body" rows="10" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 font-mono text-sm"><?= e($section['body'] ?? '') ?></textarea>
  </div>
  <div class="grid gap-4 sm:grid-cols-2">
    <div>
      <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Ordem</label>
      <input type="number" name="sort_order" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2" value="<?= (int) ($section['sort_order'] ?? 0) ?>">
    </div>
    <div class="flex items-end">
      <label class="flex items-center gap-2 text-sm">
        <input type="checkbox" name="is_active" value="1" <?= !empty($section['is_active']) ? 'checked' : '' ?>>
        Ativo
      </label>
    </div>
  </div>
  <button type="submit" class="rounded-full bg-gold px-8 py-2 text-sm font-bold uppercase text-charcoal">Salvar</button>
  <a href="/admin/sections" class="ml-4 text-sm text-ivory/55">Voltar</a>
</form>
