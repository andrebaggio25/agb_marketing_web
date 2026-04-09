<?php
/** @var array<int, array<string,mixed>> $leads */
?>
<h1 class="font-display text-2xl font-bold">Leads</h1>
<div class="mt-8 overflow-x-auto rounded-xl border border-white/10">
  <table class="min-w-full text-left text-sm">
    <thead class="border-b border-white/10 bg-white/5 text-xs uppercase text-ivory/45">
      <tr>
        <th class="px-4 py-3">Data</th>
        <th class="px-4 py-3">Nome</th>
        <th class="px-4 py-3">E-mail</th>
        <th class="px-4 py-3">Empresa</th>
        <th class="px-4 py-3">Status</th>
        <th class="px-4 py-3"></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($leads as $l): ?>
      <tr class="border-b border-white/5 hover:bg-white/[0.02]">
        <td class="px-4 py-3 text-ivory/55"><?= e(substr((string) $l['created_at'], 0, 16)) ?></td>
        <td class="px-4 py-3 font-medium"><?= e($l['name']) ?></td>
        <td class="px-4 py-3"><?= e($l['email']) ?></td>
        <td class="px-4 py-3 text-ivory/55"><?= e($l['company'] ?? '—') ?></td>
        <td class="px-4 py-3"><span class="rounded-full bg-burgundy/40 px-2 py-0.5 text-xs"><?= e($l['status']) ?></span></td>
        <td class="px-4 py-3"><a href="/admin/leads/<?= (int) $l['id'] ?>" class="text-gold hover:underline">Abrir</a></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
