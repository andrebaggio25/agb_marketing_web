<?php
/** @var array<string,mixed>|null $category */
use App\Core\Csrf;
$editing = $category !== null;
?>
<h1 class="font-display text-2xl font-bold"><?= $editing ? 'Editar categoria' : 'Nova categoria' ?></h1>
<form method="post" action="<?= $editing ? '/admin/categories/' . (int) $category['id'] : '/admin/categories' ?>" class="mt-8 max-w-lg space-y-4">
  <?= Csrf::field() ?>
  <div>
    <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Nome</label>
    <input name="name" required class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2" value="<?= e($category['name'] ?? '') ?>">
  </div>
  <div>
    <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Slug</label>
    <input name="slug" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2" value="<?= e($category['slug'] ?? '') ?>">
  </div>
  <button type="submit" class="rounded-full bg-gold px-8 py-2 text-sm font-bold uppercase text-charcoal">Salvar</button>
  <a href="/admin/categories" class="ml-4 text-sm text-ivory/55">Cancelar</a>
</form>
