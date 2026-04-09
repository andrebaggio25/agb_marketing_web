<?php
/** @var array<int, array<string,mixed>> $sections */
?>
<h1 class="font-display text-2xl font-bold">Seções da página inicial</h1>
<p class="mt-1 text-sm text-ivory/55">Edite textos por bloco (página: home).</p>
<div class="mt-8 overflow-x-auto rounded-xl border border-white/10">
  <table class="min-w-full text-left text-sm">
    <thead class="border-b border-white/10 bg-white/5 text-xs uppercase text-ivory/45">
      <tr>
        <th class="px-4 py-3">Chave</th>
        <th class="px-4 py-3">Título</th>
        <th class="px-4 py-3">Ativo</th>
        <th class="px-4 py-3"></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($sections as $s): ?>
      <tr class="border-b border-white/5">
        <td class="px-4 py-3 font-mono text-xs text-gold/90"><?= e($s['section_key']) ?></td>
        <td class="px-4 py-3 max-w-xs truncate"><?= e($s['title'] ?? '—') ?></td>
        <td class="px-4 py-3"><?= !empty($s['is_active']) ? 'sim' : 'não' ?></td>
        <td class="px-4 py-3 text-right"><a href="/admin/sections/<?= (int) $s['id'] ?>/edit" class="text-gold hover:underline">Editar</a></td>
      </tr>
      <?php endforeach; ?>
      <?php if (empty($sections)): ?>
      <tr><td colspan="4" class="px-4 py-6 text-center text-ivory/45">Nenhuma seção. Rode o seed ou crie via banco.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
