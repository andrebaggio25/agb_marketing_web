<?php
/** @var array<string,mixed>|null $post */
/** @var array<int, array<string,mixed>> $categories */
use App\Core\Csrf;
$editing = $post !== null;
?>
<h1 class="font-display text-2xl font-bold"><?= $editing ? 'Editar post' : 'Novo post' ?></h1>
<form method="post" action="<?= $editing ? '/admin/posts/' . (int) $post['id'] : '/admin/posts' ?>" class="mt-8 max-w-3xl space-y-4">
  <?= Csrf::field() ?>
  <div>
    <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Título</label>
    <input name="title" required class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2" value="<?= e($post['title'] ?? '') ?>">
  </div>
  <div>
    <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Slug</label>
    <input name="slug" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2" value="<?= e($post['slug'] ?? '') ?>">
  </div>
  <div>
    <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Categoria</label>
    <select name="category_id" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2">
      <option value="0">—</option>
      <?php foreach ($categories as $c): ?>
      <option value="<?= (int) $c['id'] ?>" <?= (int) ($post['category_id'] ?? 0) === (int) $c['id'] ? 'selected' : '' ?>><?= e($c['name']) ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div>
    <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Resumo</label>
    <textarea name="excerpt" rows="3" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2"><?= e($post['excerpt'] ?? '') ?></textarea>
  </div>
  <div>
    <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Conteúdo (HTML)</label>
    <textarea name="body" rows="14" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 font-mono text-sm"><?= e($post['body'] ?? '') ?></textarea>
  </div>
  <div class="grid gap-4 sm:grid-cols-2">
    <div>
      <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Status</label>
      <select name="status" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2">
        <option value="draft" <?= ($post['status'] ?? '') === 'draft' ? 'selected' : '' ?>>Rascunho</option>
        <option value="published" <?= ($post['status'] ?? '') === 'published' ? 'selected' : '' ?>>Publicado</option>
      </select>
    </div>
    <div>
      <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Publicado em</label>
      <input type="datetime-local" name="published_at" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2"
        value="<?= $post['published_at'] ? e(substr(str_replace(' ', 'T', (string) $post['published_at']), 0, 16)) : '' ?>">
    </div>
  </div>
  <div class="grid gap-4 sm:grid-cols-2">
    <div>
      <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Meta título</label>
      <input name="meta_title" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2" value="<?= e($post['meta_title'] ?? '') ?>">
    </div>
    <div>
      <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Meta descrição</label>
      <input name="meta_description" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2" value="<?= e($post['meta_description'] ?? '') ?>">
    </div>
  </div>
  <button type="submit" class="rounded-full bg-gold px-8 py-2 text-sm font-bold uppercase text-charcoal">Salvar</button>
  <a href="/admin/posts" class="ml-4 text-sm text-ivory/55">Cancelar</a>
</form>
