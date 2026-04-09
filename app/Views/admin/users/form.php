<?php
/** @var array<string,mixed>|null $user */
/** @var int|null $userId */
use App\Core\Csrf;
$editing = $user !== null;
$uid = $userId ?? ($user['id'] ?? null);
?>
<h1 class="font-display text-2xl font-bold"><?= $editing ? 'Editar usuário' : 'Novo usuário' ?></h1>
<form method="post" action="<?= $editing ? '/admin/users/' . (int) $uid : '/admin/users' ?>" class="mt-8 max-w-lg space-y-4">
  <?= Csrf::field() ?>
  <div>
    <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Nome</label>
    <input name="name" required class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2" value="<?= e($user['name'] ?? '') ?>">
  </div>
  <div>
    <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">E-mail</label>
    <input type="email" name="email" required class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2" value="<?= e($user['email'] ?? '') ?>">
  </div>
  <div>
    <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Senha <?= $editing ? '(deixe em branco para manter)' : '' ?></label>
    <input type="password" name="password" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2" <?= $editing ? '' : 'required' ?> autocomplete="new-password">
  </div>
  <div>
    <label class="mb-1 block text-xs font-bold uppercase text-ivory/50">Papel</label>
    <select name="role" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2">
      <option value="editor" <?= ($user['role'] ?? '') === 'editor' ? 'selected' : '' ?>>Editor</option>
      <option value="admin" <?= ($user['role'] ?? '') === 'admin' ? 'selected' : '' ?>>Admin</option>
    </select>
  </div>
  <button type="submit" class="rounded-full bg-gold px-8 py-2 text-sm font-bold uppercase text-charcoal">Salvar</button>
  <a href="/admin/users" class="ml-4 text-sm text-ivory/55">Cancelar</a>
</form>
