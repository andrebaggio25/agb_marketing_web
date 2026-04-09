<?php
/** @var array<int, array<string,mixed>> $users */
use App\Core\Csrf;
?>
<div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
  <h1 class="font-display text-2xl font-bold">Usuários</h1>
  <a href="/admin/users/create" class="rounded-full bg-gold px-5 py-2 text-sm font-bold uppercase text-charcoal">Novo</a>
</div>
<div class="mt-8 overflow-x-auto rounded-xl border border-white/10">
  <table class="min-w-full text-left text-sm">
    <thead class="border-b border-white/10 bg-white/5 text-xs uppercase text-ivory/45">
      <tr><th class="px-4 py-3">Nome</th><th class="px-4 py-3">E-mail</th><th class="px-4 py-3">Papel</th><th class="px-4 py-3"></th></tr>
    </thead>
    <tbody>
      <?php foreach ($users as $u): ?>
      <tr class="border-b border-white/5">
        <td class="px-4 py-3"><?= e($u['name']) ?></td>
        <td class="px-4 py-3"><?= e($u['email']) ?></td>
        <td class="px-4 py-3"><?= e($u['role']) ?></td>
        <td class="px-4 py-3 text-right">
          <a href="/admin/users/<?= (int) $u['id'] ?>/edit" class="text-gold hover:underline">Editar</a>
          <form action="/admin/users/<?= (int) $u['id'] ?>/delete" method="post" class="inline" onsubmit="return confirm('Excluir usuário?');">
            <?= Csrf::field() ?>
            <button type="submit" class="ml-3 text-red-400 hover:underline">Excluir</button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
