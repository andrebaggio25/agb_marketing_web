<?php
/** @var array<string,mixed> $lead */
/** @var array<int, array<string,mixed>> $notes */
use App\Core\Csrf;
?>
<div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
  <div>
    <h1 class="font-display text-2xl font-bold">Lead #<?= (int) $lead['id'] ?></h1>
    <p class="mt-1 text-sm text-ivory/55"><?= e($lead['created_at']) ?></p>
  </div>
  <form method="post" action="/admin/leads/<?= (int) $lead['id'] ?>/status" class="flex flex-wrap items-center gap-2">
    <?= Csrf::field() ?>
    <select name="status" class="rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-sm">
      <?php foreach (['new','contacted','qualified','lost','won'] as $st): ?>
      <option value="<?= $st ?>" <?= $lead['status'] === $st ? 'selected' : '' ?>><?= $st ?></option>
      <?php endforeach; ?>
    </select>
    <button type="submit" class="rounded-full bg-gold px-4 py-2 text-xs font-bold uppercase text-charcoal">Atualizar</button>
  </form>
</div>
<div class="mt-8 grid gap-6 lg:grid-cols-2">
  <div class="rounded-xl border border-white/10 bg-white/[0.03] p-6">
    <h2 class="font-display font-bold">Dados</h2>
    <dl class="mt-4 space-y-2 text-sm">
      <div><dt class="text-ivory/45">Nome</dt><dd><?= e($lead['name']) ?></dd></div>
      <div><dt class="text-ivory/45">E-mail</dt><dd><a href="mailto:<?= e($lead['email']) ?>" class="text-gold"><?= e($lead['email']) ?></a></dd></div>
      <div><dt class="text-ivory/45">Telefone</dt><dd><?= e($lead['phone'] ?? '—') ?></dd></div>
      <div><dt class="text-ivory/45">Empresa</dt><dd><?= e($lead['company'] ?? '—') ?></dd></div>
      <div><dt class="text-ivory/45">Mensagem</dt><dd class="whitespace-pre-wrap"><?= e($lead['message'] ?? '—') ?></dd></div>
      <div><dt class="text-ivory/45">Origem</dt><dd><?= e($lead['source']) ?></dd></div>
    </dl>
  </div>
  <div class="rounded-xl border border-white/10 bg-white/[0.03] p-6">
    <h2 class="font-display font-bold">Notas</h2>
    <form method="post" action="/admin/leads/<?= (int) $lead['id'] ?>/note" class="mt-4 space-y-2">
      <?= Csrf::field() ?>
      <textarea name="body" rows="3" class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-sm" placeholder="Registrar follow-up..."></textarea>
      <button type="submit" class="rounded-full bg-burgundy px-4 py-2 text-xs font-bold uppercase">Adicionar nota</button>
    </form>
    <ul class="mt-6 space-y-4 text-sm">
      <?php foreach ($notes as $n): ?>
      <li class="border-l-2 border-gold/40 pl-4">
        <p class="text-ivory/45 text-xs"><?= e($n['created_at']) ?> <?= $n['user_name'] ? ' · ' . e($n['user_name']) : '' ?></p>
        <p class="mt-1 whitespace-pre-wrap"><?= e($n['body']) ?></p>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>
<p class="mt-8"><a href="/admin/leads" class="text-gold hover:underline">← Voltar</a></p>
