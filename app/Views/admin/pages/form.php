<?php
/** @var array<string,mixed>|null $page */
use App\Core\Csrf;
$editing = $page !== null;
?>
<h1 class="font-display text-2xl font-bold"><?= $editing ? 'Editar página' : 'Nova página' ?></h1>
<form method="post" action="<?= $editing ? '/admin/pages/' . (int) $page['id'] : '/admin/pages' ?>" class="mt-8 max-w-3xl space-y-4">
  <?= Csrf::field() ?>
  <div>
    <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Título</label>
    <input name="title" required class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2" value="<?= e($page['title'] ?? '') ?>">
  </div>
  <div>
    <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Slug (URL)</label>
    <input name="slug" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2" placeholder="auto a partir do título" value="<?= e($page['slug'] ?? '') ?>">
  </div>
  <div>
    <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Conteúdo (HTML)</label>
    <textarea name="body" rows="14" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 font-mono text-sm"><?= e($page['body'] ?? '') ?></textarea>
  </div>
  <div>
    <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Status</label>
    <select name="status" class="rounded-lg border border-white/10 bg-white/5 px-3 py-2">
      <option value="draft" <?= ($page['status'] ?? '') === 'draft' ? 'selected' : '' ?>>Rascunho</option>
      <option value="published" <?= ($page['status'] ?? '') === 'published' ? 'selected' : '' ?>>Publicado</option>
    </select>
  </div>
  <div class="grid gap-4 sm:grid-cols-2">
    <div>
      <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Meta título (SEO)</label>
      <input name="meta_title" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2" value="<?= e($page['meta_title'] ?? '') ?>">
    </div>
    <div>
      <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Meta descrição</label>
      <input name="meta_description" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2" value="<?= e($page['meta_description'] ?? '') ?>">
    </div>
  </div>
  <button type="submit" class="rounded-full bg-gold px-8 py-2 text-sm font-bold uppercase text-charcoal">Salvar</button>
  <a href="/admin/pages" class="ml-4 text-sm text-ivory/55 hover:text-ivory">Cancelar</a>
</form>
