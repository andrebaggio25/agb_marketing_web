<?php
/** @var array<int, array<string,mixed>> $recentLeads */
/** @var int $countPages */
/** @var int $countPosts */
?>
<div>
  <h1 class="font-display text-2xl font-bold">Painel</h1>
  <p class="mt-1 text-sm text-ivory/55">Visão geral do site e leads recentes.</p>
  <div class="mt-8 grid gap-4 sm:grid-cols-3">
    <div class="rounded-xl border border-white/10 bg-white/[0.03] p-6">
      <p class="text-xs uppercase tracking-wider text-ivory/45">Páginas</p>
      <p class="mt-2 font-display text-3xl font-bold text-gold"><?= (int) $countPages ?></p>
    </div>
    <div class="rounded-xl border border-white/10 bg-white/[0.03] p-6">
      <p class="text-xs uppercase tracking-wider text-ivory/45">Posts</p>
      <p class="mt-2 font-display text-3xl font-bold text-gold"><?= (int) $countPosts ?></p>
    </div>
    <div class="rounded-xl border border-white/10 bg-white/[0.03] p-6">
      <p class="text-xs uppercase tracking-wider text-ivory/45">Leads (últimos)</p>
      <p class="mt-2 font-display text-3xl font-bold text-gold"><?= count($recentLeads) ?></p>
    </div>
  </div>
  <div class="mt-10">
    <h2 class="font-display text-lg font-bold">Leads recentes</h2>
    <div class="mt-4 overflow-x-auto rounded-xl border border-white/10">
      <table class="min-w-full text-left text-sm">
        <thead class="border-b border-white/10 bg-white/5 text-xs uppercase text-ivory/45">
          <tr>
            <th class="px-4 py-3">Data</th>
            <th class="px-4 py-3">Nome</th>
            <th class="px-4 py-3">E-mail</th>
            <th class="px-4 py-3">Status</th>
            <th class="px-4 py-3"></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($recentLeads as $l): ?>
          <tr class="border-b border-white/5 hover:bg-white/[0.02]">
            <td class="px-4 py-3 text-ivory/65"><?= e(substr((string) $l['created_at'], 0, 16)) ?></td>
            <td class="px-4 py-3 font-medium"><?= e($l['name']) ?></td>
            <td class="px-4 py-3"><?= e($l['email']) ?></td>
            <td class="px-4 py-3"><span class="rounded-full bg-burgundy/40 px-2 py-0.5 text-xs"><?= e($l['status']) ?></span></td>
            <td class="px-4 py-3"><a href="/admin/leads/<?= (int) $l['id'] ?>" class="text-gold hover:underline">Ver</a></td>
          </tr>
          <?php endforeach; ?>
          <?php if (empty($recentLeads)): ?>
          <tr><td colspan="5" class="px-4 py-6 text-center text-ivory/45">Nenhum lead ainda.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
