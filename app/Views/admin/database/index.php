<?php
/** @var array{version: string|null, tables: list<array{name: string, rows: int|string|null, engine: string|null}>}|null $overview */
/** @var list<string> $applied */
/** @var list<string> $pending */
/** @var string $dbHost */
/** @var string $dbName */
/** @var string $dbUser */
/** @var string $dbPort */
/** @var string|null $connectionError */
use App\Core\Csrf;
?>
<div>
  <h1 class="font-display text-2xl font-bold">Banco de dados</h1>
  <p class="mt-1 text-sm text-ivory/55">Conexão, tabelas e execução de migrations (somente administrador).</p>

  <?php if ($connectionError): ?>
  <div class="mt-6 rounded-xl border border-red-500/40 bg-red-500/10 px-4 py-3 text-sm text-red-200">
    Não foi possível consultar o banco: <?= e($connectionError) ?>
  </div>
  <?php else: ?>

  <div class="mt-8 grid gap-4 sm:grid-cols-2">
    <div class="rounded-xl border border-white/10 bg-white/[0.03] p-5">
      <h2 class="font-display text-sm font-bold uppercase tracking-wider text-gold/90">Conexão</h2>
      <dl class="mt-3 space-y-2 text-sm">
        <div class="flex justify-between gap-4"><dt class="text-ivory/45">Host</dt><dd class="font-mono text-xs"><?= e($dbHost) ?>:<?= e($dbPort) ?></dd></div>
        <div class="flex justify-between gap-4"><dt class="text-ivory/45">Base</dt><dd class="font-mono text-xs"><?= e($dbName) ?></dd></div>
        <div class="flex justify-between gap-4"><dt class="text-ivory/45">Usuário</dt><dd class="font-mono text-xs"><?= e($dbUser) ?></dd></div>
        <div class="flex justify-between gap-4"><dt class="text-ivory/45">MySQL</dt><dd class="font-mono text-xs"><?= e($overview['version'] ?? '—') ?></dd></div>
      </dl>
      <p class="mt-3 text-xs text-ivory/40">A senha nunca é exibida.</p>
    </div>

    <div class="rounded-xl border border-white/10 bg-white/[0.03] p-5">
      <h2 class="font-display text-sm font-bold uppercase tracking-wider text-gold/90">Migrations</h2>
      <p class="mt-2 text-sm text-ivory/65">
        Pendentes: <strong class="text-ivory"><?= count($pending) ?></strong>
        · Aplicadas: <strong class="text-ivory"><?= count($applied) ?></strong>
      </p>
      <?php if ($pending !== []): ?>
      <ul class="mt-3 max-h-32 list-inside list-disc overflow-y-auto text-xs text-amber-200/90">
        <?php foreach ($pending as $p): ?>
        <li class="font-mono"><?= e($p) ?></li>
        <?php endforeach; ?>
      </ul>
      <form method="post" action="/admin/database/migrate" class="mt-4">
        <?= Csrf::field() ?>
        <button type="submit" class="rounded-full bg-gold px-6 py-2 text-sm font-bold uppercase text-charcoal">
          Aplicar migrations pendentes
        </button>
      </form>
      <?php else: ?>
      <p class="mt-3 text-sm text-gold/80">Todas as migrations já foram aplicadas.</p>
      <?php endif; ?>
    </div>
  </div>

  <div class="mt-8">
    <h2 class="font-display text-lg font-bold">Tabelas</h2>
    <p class="mt-1 text-xs text-ivory/45">Estimativa de linhas (InnoDB pode ser aproximada).</p>
    <div class="mt-4 overflow-x-auto rounded-xl border border-white/10">
      <table class="min-w-full text-left text-sm">
        <thead class="border-b border-white/10 bg-white/5 text-xs uppercase text-ivory/45">
          <tr>
            <th class="px-4 py-3">Tabela</th>
            <th class="px-4 py-3">Engine</th>
            <th class="px-4 py-3">Linhas (est.)</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($overview['tables'] ?? [] as $t): ?>
          <tr class="border-b border-white/5">
            <td class="px-4 py-2 font-mono text-xs"><?= e($t['name']) ?></td>
            <td class="px-4 py-2 text-ivory/55"><?= e($t['engine'] ?? '—') ?></td>
            <td class="px-4 py-2"><?= e((string) ($t['rows'] ?? '—')) ?></td>
          </tr>
          <?php endforeach; ?>
          <?php if (($overview['tables'] ?? []) === []): ?>
          <tr><td colspan="3" class="px-4 py-6 text-center text-ivory/45">Nenhuma tabela ou sem permissão information_schema.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="mt-8 rounded-xl border border-white/10 bg-burgundy-dark/20 p-4 text-xs text-ivory/55">
    <strong class="text-ivory/80">Segurança:</strong> desative em produção se não precisar —
    defina <code class="rounded bg-black/30 px-1">DB_ADMIN_ENABLED=false</code> no ambiente.
  </div>

  <?php endif; ?>
</div>
