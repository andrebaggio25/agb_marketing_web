<?php
/** @var array<int, array<string,mixed>> $posts */
/** @var array<string, string|null> $settings */
require VIEW_PATH . '/site/partials/nav_public.php';
?>
<div class="mx-auto max-w-4xl px-4 py-16 sm:px-6">
  <h1 class="font-display text-4xl font-bold">Blog</h1>
  <p class="mt-3 text-ivory/65">Estratégia, performance e crescimento.</p>
  <ul class="mt-12 space-y-8">
    <?php foreach ($posts as $post): ?>
    <li class="rounded-2xl border border-white/10 bg-white/[0.03] p-6 transition hover:border-gold/25">
      <a href="/blog/<?= e($post['slug']) ?>" class="block">
        <span class="text-xs font-bold uppercase tracking-wider text-gold"><?= e($post['category_name'] ?? 'Artigo') ?></span>
        <h2 class="mt-2 font-display text-2xl font-bold text-ivory"><?= e($post['title']) ?></h2>
        <?php if (!empty($post['excerpt'])): ?>
        <p class="mt-3 text-ivory/65"><?= e($post['excerpt']) ?></p>
        <?php endif; ?>
      </a>
    </li>
    <?php endforeach; ?>
    <?php if (empty($posts)): ?>
    <li class="text-ivory/50">Nenhum post publicado ainda.</li>
    <?php endif; ?>
  </ul>
</div>
